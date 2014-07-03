<?php
namespace Colizen\AdminBundle\Importer;

use Doctrine\ORM\EntityManagerInterface;
use Colizen\AdminBundle\Command\OutputHandler\WebServiceOutputHandler;
use \Swift_Mailer;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Colizen\AdminBundle\SoapClient\ColizenWebService;
use Doctrine\ORM\EntityManager\EntityManagerInterface;
use Colizen\AdminBundle\Entity\ImportWebServiceLog;

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
     * @param \Colizen\AdminBundle\Command\OutputHandler\WebServiceOutputHandler $output
     * @throws \Colizen\AdminBundle\Importer\Exception
     */
    public function execute(WebServiceOutputHandler $output=null) {
        if ($output instanceof WebServiceOutputHandler){
            $output->write('Import started : '.$this->getActionName(), ImportWebServiceLog::MESSAGE_LEVEL_GLOBAL);
        }
        foreach ($this->getCargopassesForRequest() as $cargopass){
            try{
                $this->webservice->getShipmentTrace(750, $cargopass);
            } catch (\Exception $ex) {
                if ($output instanceof OutputHandler){
                        $output->write('Error Appel WebService : ', ImportWebServiceLog::MESSAGE_LEVEL_CALL, true,$cargopass);
                    } else {
                        throw $ex;
                    }
            }
        }
        if ($output instanceof OutputHandler){
            $output->write('Import done : '.$this->getActionName(), ImportWebServiceLog::MESSAGE_LEVEL_GLOBAL);
        }
        
    }
    
    protected function getCargopassesForRequest(){
        return $this->em->getRepository('ColizenAdminBundle:ImportLog')->findTodaysCargopassesInThirteenNumberFormat();
    }


}
