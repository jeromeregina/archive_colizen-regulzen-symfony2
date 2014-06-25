<?php
namespace Novactive\AdminBundle\Importer;

use Liuggio\ExcelBundle\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Novactive\AdminBundle\Command\OutputHandler\OutputHandler;
use Novactive\AdminBundle\Entity\Shipment;
use Novactive\AdminBundle\Entity\DeliveryAddress;

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
    * E -> code agence expediteur
    * F -> date d'expedition
    * G -> poids
    * H -> nombre de colis
 * K -> priorité de la livraison (?)
 * L -> code agence ? = 750 ? à importer ?
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
               $shipment= $this->getShipmentRepository()->resolveByCargopass($line['C']);
               
               $site= $this->getSiteRepository()->findOneByAnyCode($line['E']);
               
               $shipment->setCargopass($line['C'])
                       ->setShipperId($line['D'])
                       ->setCreationDate(\DateTime::createFromFormat('d.m.Y',$line['F']))
                       ->setDeliveryDate(\DateTime::createFromFormat('H:i',$line['AC']))
                       ->setParcelQuantity($line['H'])
                       ->setSite($site)
                       ->setWeight($line['G'])
                       ;
               
               $deliveryAddress=($shipment->hasDeliveryAddress())?$shipment->getDeliveryAddress():new DeliveryAddress();
               
               
               $deliveryAddress
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
                       ->setShipment($shipment)
                       ;
               
               $shipment->setDeliveryAddress($deliveryAddress);
               // à afiner
               $tourCode =  new \Novactive\AdminBundle\Entity\TourCode();
               
               //
               $this->em->persist($shipment);
               $this->em->flush();
               
               
                       
//           * K -> priorité de la livraison (?)
// * L -> code agence ? = 750 ? à importer ?
// * M -> code tournée
// * N -> position du bordereau
// * O -> date tournée
// * P -> créneau horaire     
//               var_dump($shipment);die;
//               $this->em->persist($shipment);
               
//               $sender = $this->getSenderRepository()->findOneBy(array(''))
                              
            }
        
            protected function getActionName() {
                return 'Excels liste camionage après routeur';
            }
}
