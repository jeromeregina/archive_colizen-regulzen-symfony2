<?php
namespace Novactive\AdminBundle\Importer;

use Liuggio\ExcelBundle\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Novactive\AdminBundle\Command\OutputHandler\OutputHandler;
use Novactive\AdminBundle\Entity\Shipment;
class TourPlanning extends AbstractImporter  {
    /**
     *
     * @var Factory
     */
    protected $phpExcel;
    
    public function __construct(EntityManagerInterface $em, $sourceDirectory, $filenamePattern, Factory $phpExcel) {
        $this->phpExcel=$phpExcel;
        parent::__construct($em, $sourceDirectory, $filenamePattern);
    }

    /**
     * 
     * @param SplFileInfo $file (or string for filename)
     * @return array
     */
    protected function getLinesFromFile(SplFileInfo $file){
        $peo=$this->phpExcel->createPHPExcelObject($file);
        $sheetData=$peo->getActiveSheet()->toArray(null,true,true,true);
        // suppression de la ligne d'entête (meilleure solution?)
        array_shift( $sheetData);
        return $sheetData;
    }
/**
    * C -> cargopass
    * D -> code client -> shipper id
 * E -> code agence expediteur ?
    * F -> date d'expedition
    * G -> poids
    * H -> nombre de colis
 * K -> priorité de la livraison (?)
 * L -> code agence ? = 750
 * M -> code tournée
 * N -> position du bordereau
 * O -> date tournée
 * P -> créneau horaire
    * R -> détails de l'adresse de livraison
    * S -> adresse de livraison : pays
    * T -> adresse de livraison : cp
    * U -> adresse de livraison : ville
    * V -> adresse de livraison : adress
    * W -> adresse de livraison : nom destinataire
    * X -> telephone destinataire
    * Y -> email destinataire
    * Z -> latitude
    * AA -> longitude
    * AC -> heure planifiée
 * 
 * @param array $line
 */
    protected function persistLine($line,SplFileInfo $file,OutputHandler $output = null) {
        if ($output instanceof OutputHandler)
            { 
            $output->write('importing "'.$line['C'].'" from file "'.$file->getFilename().'"');
            }
               $shipment= $this->getShipmentRepository()->findOneBy(array('cargopass'=>$line['C']));
               $shipment=($shipment instanceof Shipment)?$shipment:new Shipment();
               
               /*
                * ne marcheras pas
                */
               $site= $this->getSiteRepository()->findOneBy(array('code'=>$line['L']));
               
               $shipment->setCargopass($line['C'])
                        ->setShipperId($line['D'])
                       ->setCreationDate(\DateTime::createFromFormat('d.m.Y',$line['F']))
                       ->setDeliveryDate(\DateTime::createFromFormat('H:i',$line['AC']))
                       ->setParcelQuantity($line['H'])
                       ->setSite(new \Novactive\AdminBundle\Entity\Site())
                       ->setWeight($line['G'])
                       ;
               
               $shipment->getDeliveryAddress()
                       ->setAddress($line['V'])
                       ->setAdditionalInformations(($line['R']=='<?>')?null:$line['R'])
                       ->setCountry($line['S'])
                       ->setZipcode($line['T'])
                       ->setCity($line['U'])
                       ->setName($line['W'])
                       ->setTelephone(($line['X']=='<?>')?null:$line['X'])
                       ->setEmail(($line['Y']=='<?>')?null:$line['Y'])
                       ->setLatitude($line['Z'])
                       ->setLongitude($line['AA'])
                       ;
               
               var_dump($shipment);die;
//               $this->em->persist($shipment);
//               $this->em->flush();
//               $sender = $this->getSenderRepository()->findOneBy(array(''))
               
               
            }

            protected function getActionName() {
                return 'Excels liste camionage après routeur';
            }
}
