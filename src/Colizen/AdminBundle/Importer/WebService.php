<?php
namespace Colizen\AdminBundle\Importer;

use Doctrine\ORM\EntityManagerInterface;
use Colizen\AdminBundle\Command\OutputHandler\WebServiceOutputHandler;
use \Swift_Mailer;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Colizen\AdminBundle\SoapClient\ColizenWebService;
use Doctrine\ORM\EntityManager\EntityManagerInterface;
use Colizen\AdminBundle\Entity\ImportWebServiceLog;
use Colizen\AdminBundle\Entity\Event;

class WebService
{
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

    public function __construct(EntityManagerInterface $em, ColizenWebService $webservice, Swift_Mailer $mailer, TimedTwigEngine $templating, $mailTemplate)
    {
        $this->em=$em;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->mailTemplate=$mailTemplate;
        $this->webservice=$webservice;
    }
    /**
     * execute file imports, writes logs to OutputHandler if not null
     *
     * @param  \Colizen\AdminBundle\Command\OutputHandler\WebServiceOutputHandler $output
     * @throws \Colizen\AdminBundle\Importer\Exception
     */
    public function execute(WebServiceOutputHandler $output=null)
    {
        if ($output instanceof WebServiceOutputHandler) {
            $output->write('Import started : '.$this->getActionName(), ImportWebServiceLog::MESSAGE_LEVEL_GLOBAL);
        }
        foreach ($this->getCargopassesForRequest() as $cargopass) {
            try {
                $this->persistResponse($cargopass,$this->webservice->getShipmentTrace(750, $this->formatCargopassForCall($cargopass)),$output);
            } catch (\Exception $ex) {
                if ($output instanceof OutputHandler) {
                        $output->write('Error Appel WebService : ', ImportWebServiceLog::MESSAGE_LEVEL_CALL, true,$cargopass);
                    } else {
                        throw $ex;
                    }
            }
        }
        if ($output instanceof OutputHandler) {
            $output->write('Import done : '.$this->getActionName(), ImportWebServiceLog::MESSAGE_LEVEL_GLOBAL);
        }

    }

    protected function persistResponse($cargopass,$response,$output)
    {
            /* @var $parcel \Colizen\AdminBundle\Entity\Parcel */
            $parcel=$this->em->getRepository('ColizenAdminBundle:Parcel')->findOneBy(array('cargopass'=>$cargopass));
            /** maj de l'addresse **/
            $address=$parcel->getShipment()->getDeliveryAddress();
            $address->setCountry($response->DestinationCountry)
                    ->setZipcode($response->DestinationZipcode);
            /** ajout des events**/
            $tmpDate=0;
            $tmpStatus=null;
            foreach ($response->Traces as $t) {
                $event = new Event();
                $event->setDate(\DateTime::createFromFormat('d.m.Y', $t->ScanDate))
                      ->setScanHour(\DateTime::createFromFormat('H:i:s', $t->ScanDate))
                      ->setScanStatusCode($t->StatusNumber)
                        ;
                /* pour stoquer le status le plus récent (à mettre au niveau de l'objet Parcel */
                if ($tmpDate==0||$tmpDate<$t->ScanDate) $tmpDate=$t->ScanDate;
                if ($tmpStatus==null||$tmpDate<$t->ScanDate) $tmpStatus=$t->StatusNumber;

                $parcel->addEvent($event);
            }
            /** maj parcel **/
            $parcel->setWeight($response->Weight)
                   ->setStatus($tmpStatus)
                    ;
            $this->em->persist($parcel);
            $this->em->flush();

        if ($output instanceof WebServiceOutputHandler) {
            $output->write('importing "'.$cargopass.'" from webservice',  ImportWebServiceLog::MESSAGE_LEVEL_CALL, false, $cargopass,$tmpStatus);
            }
    }

    protected function formatCargopassForCall($cargopass)
    {
        return preg_replace('/(\d{6})(\d{2})(\d{7})/','$1$3',$cargopass);
    }
    protected function getCargopassesForRequest()
    {
        return $this->em->getRepository('ColizenAdminBundle:ImportLog')->findTodaysCargopasses();
    }

}
