<?php
namespace Colizen\AdminBundle\Importer;

use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\ORM\EntityManager;
use Symfony\Component\Finder\SplFileInfo;
use Colizen\AdminBundle\Command\OutputHandler\OutputHandler;
use Colizen\AdminBundle\Entity\ImportLog;

abstract class AbstractImporter {
    /**
     *
     * @var EntityManager
     */
    protected $em;
    protected $sourceDirectory;
    /**
     *
     * @var Finder
     */
    protected $finder;
    protected $filenamePattern;
    public function __construct(EntityManagerInterface $em, $sourceDirectory, $filenamePattern) {
        $this->em=$em;
        $this->sourceDirectory=$sourceDirectory;
        $this->filenamePattern=$filenamePattern;
        $this->finder=new Finder();
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
        return $output;
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
     * @return \Colizen\AdminBundle\Repository\SenderAccount
     */
    protected function getSenderAccountRepository(){
       return $this->em->getRepository('ColizenAdminBundle:SenderAccount');
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
}
