<?php
namespace Colizen\AdminBundle\Importer;

use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\ORM\EntityManager;
use Symfony\Component\Finder\SplFileInfo;
use Colizen\AdminBundle\Command\OutputHandler\OutputHandler;
use Colizen\AdminBundle\Entity\ImportLog;
use \Swift_Mailer;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;

abstract class AbstractImporter {
    /**
     *
     * @var EntityManager
     */
    protected $em;
    /**
     * source directory for files to import
     * @var string
     */
    protected $sourceDirectory;
    /**
     *
     * @var \Swift_Mailer
     */
    protected $mailer;
    /**
     *
     * @var string
     */
    protected $mailTemplate;
    /**
     *
     * @var \Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine 
     */
    protected $templating;
    /**
     *
     * @var Finder
     */
    protected $finder;
    protected $filenamePattern;
    /**
     * 
     * lignes d'infos de l'email en destination des admins
     * 
     * @var array
     */
    protected $emailLines=array();
    
    public function __construct(EntityManagerInterface $em, $sourceDirectory, $filenamePattern, Swift_Mailer $mailer, TimedTwigEngine $templating,$mailTemplate) {
        $this->em=$em;
        $this->sourceDirectory=$sourceDirectory;
        $this->filenamePattern=$filenamePattern;
        $this->finder=new Finder();
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->mailTemplate=$mailTemplate;
    }
    /**
     * execute file imports, writes logs to OutputHandler if not null
     * 
     * @param \Colizen\AdminBundle\Command\OutputHandler\OutputHandler $output
     * @throws \Colizen\AdminBundle\Importer\Exception
     */
     public function execute(OutputHandler $output=null) {
        if ($output instanceof OutputHandler){
            $output->write('Import started : '.$this->getActionName(), ImportLog::MESSAGE_LEVEL_ACTION);
        }
        
        $this->resetEmailLines();
        
        foreach ($this->findFiles() as $file){
            /* @var $file SplFileInfo */
                $lc=0;
            foreach ($this->getLinesFromFile($file) as $line){
                try {
                    $this->persistLine($line,$file,$output);
                } catch(\Exception $e){
                    if ($output instanceof OutputHandler){
                        $output->write('Error on '.$file->getFilename().', line '.$lc.' : '.$e->getMessage(), ImportLog::MESSAGE_LEVEL_LINE);
                    } else {
                        throw $e;
                    }
                }
                $lc++;
            }
        }
        if ($this->hasEmailLines())
            $this->sendMail();
    }
    
    protected function findFiles(){
        return $this->finder->files()->in($this->sourceDirectory)->name($this->filenamePattern);
    }
    
    abstract protected function persistLine($line,SplFileInfo $file,  OutputHandler $output = null);
    abstract protected function getLinesFromFile(SplFileInfo $file);
    abstract protected function getActionName();
    /**
     * 
     * @return \Colizen\AdminBundle\Repository\Shipment
     */
    protected function getShipmentRepository(){
       return $this->em->getRepository('ColizenAdminBundle:Shipment');
    }
    /**
     * 
     * @return \Colizen\AdminBundle\Repository\ShipperAccount
     */
    protected function getShipperAccountRepository(){
       return $this->em->getRepository('ColizenAdminBundle:ShipperAccount');
    }
    /**
     * 
     * @return \Colizen\AdminBundle\Repository\Site
     */
    protected function getSiteRepository(){
       return $this->em->getRepository('ColizenAdminBundle:Site');
    }
    /**
     * 
     * @return \Colizen\AdminBundle\Repository\Tour
     */
    protected function getTourRepository(){
       return $this->em->getRepository('ColizenAdminBundle:Tour');
    }
    /**
     * 
     * @return \Colizen\UserBundle\Repository\User
     */
    protected function getUserRepository(){
       return $this->em->getRepository('ColizenUserBundle:User');
    }
    
    
    protected function sendMail(){
        
        $to=$this->getUserRepository()->getAllAdminEmails();
        
        $message = \Swift_Message::newInstance()
            ->setSubject('[Regulzen] New administrable content created')
            ->setFrom('regulzen@regulzen.com')
            ->setTo($to)
            ->setBody($this->templating->render($this->mailTemplate, array('files'=>$this->emailLines)),'text/html');
        
        $this->mailer->send($message);

    }
    /**
     * renvoie TRUE si l'action d'import à rajouté des lignes pour envoyer d'email
     * 
     * @return boolean
     */
    protected function hasEmailLines(){
        return (bool) count($this->emailLines);
    }
    protected function resetEmailLines(){
        $this->emailLines=array();
    }
    /**
     * ajoute une ligne d'information à l'email en court
     * 
     * @param string $filename nom du fichier importé 
     * @param string $lineId "identifiant" de la ligne
     * @param string $subject type d'objet créé (en minuscule séparé par des underscore, afin de générer à la volé les routes d'administration si besoin)
     * @param int $objectId identifiant de l'objet
     */
    protected function addEmailLine($filename,$lineId,$subject,$objectId){
        $this->emailLines[$filename][$lineId][]=array(
                                                        'message'=>'regulzen.mails.import.new_'.$subject,
                                                        'route'=>'admin_'.$subject.'_edit',
                                                        'objectId'=>$objectId
                                                        );
    }
}
