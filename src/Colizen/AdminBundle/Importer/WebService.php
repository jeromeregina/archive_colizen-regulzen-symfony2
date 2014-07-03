<?php
namespace Colizen\AdminBundle\Importer;

use Doctrine\ORM\EntityManagerInterface;
use Colizen\AdminBundle\Command\OutputHandler\OutputHandler;
use \Swift_Mailer;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Colizen\AdminBundle\SoapClient\ColizenWebService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
class WebService {
    /**
     *
     * @var \Doctrine\ORM\EntityManagerInterface 
     */
    protected $em;
    /**
     *
     * @var \Colizen\AdminBundle\SoapClient\ColizenWebService 
     */
    protected $webservice;
    /**
     *
     * @var \Swift_Mailer 
     */
    protected $mailer;
    /**
     *
     * @var \Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine 
     */
    protected $templating;
    /**
     *
     * @var string 
     */
    protected $mailTemplate;
    
    public function __construct(EntityManagerInterface $em, ColizenWebService $webservice, Swift_Mailer $mailer, TimedTwigEngine $templating, $mailTemplate) {
        $this->em=$em;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->mailTemplate=$mailTemplate;
        $this->webservice=$webservice;
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
        
        if ($output instanceof OutputHandler){
            $output->write('Import done : '.$this->getActionName(), ImportLog::MESSAGE_LEVEL_ACTION);
        }
        
     }
       protected function getActionName() {
                return 'Appel WebService';
            }
}
