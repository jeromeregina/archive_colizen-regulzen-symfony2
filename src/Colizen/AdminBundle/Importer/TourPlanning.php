<?php
namespace Colizen\AdminBundle\Importer;

use Liuggio\ExcelBundle\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Colizen\AdminBundle\Command\OutputHandler\OutputHandler;
use Colizen\AdminBundle\Entity\Shipment;
use Colizen\AdminBundle\Entity\DeliveryAddress;
use Colizen\AdminBundle\Entity\Slot;

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
    * C -> cargopass -> Shipment.cargopass
    * D -> code client -> Shipment.shipper_id (ShipperAccount?)
    * E -> code agence expediteur -> Shipment.Site.CodeImtech ou Shipment.Site.Number
    * F -> date d'expedition -> Shipment.creationDate
    * G -> poids -> Shipment.weight
    * H -> nombre de colis -> Shipment.parcelQuantity
    * K -> priorité de la livraison (?)
 * L -> code agence ? = 750 ? à importer ?
    * M -> code tournée
    * N -> position du bordereau
    * O -> date tournée
    * P -> créneau horaire
    * R -> détails de l'adresse de livraison -> Shipment.DeliveryAddress.additionalInformations
    * S -> adresse de livraison : pays -> Shipment.DeliveryAddress.country
    * T -> adresse de livraison : cp -> Shipment.DeliveryAddress.zipcode
    * U -> adresse de livraison : ville -> Shipment.DeliveryAddress.city
    * V -> adresse de livraison : adress -> Shipment.DeliveryAddress.address
    * W -> adresse de livraison : nom destinataire -> Shipment.DeliveryAddress.name
    * X -> telephone destinataire -> Shipment.DeliveryAddress.telephone
    * Y -> email destinataire -> Shipment.DeliveryAddress.email
    * Z -> latitude -> Shipment.DeliveryAddress.latitude
    * AA -> longitude -> Shipment.DeliveryAddress.longitude
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
               
               $site= $this->getSiteRepository()->findOneByAnyCode($line['L']);
               
               $shipment->setCargopass($line['C'])
                       ->setDeliveryDate(\DateTime::createFromFormat('d.m.Y',$line['F']))
                       ->setParcelQuantity(($line['H']==0)?1:$line['H'])
                       ->setSite($site)
                       ->setWeight($line['G'])
                       ->setPriority($line['K'])
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
               
               $tour = $this->getTourRepository()->resolveByTourCodeDateAndSite($line['M'],\DateTime::createFromFormat('[d.m.Y]',$line['O']),$site);
                
               $slot = ($shipment->getLastSlot() instanceof Slot)?$shipment->getLastSlot():new Slot();
               
               list($slotStart,$slotEnd)=explode('-',trim($line['P'],'[]'));
               
               $slot->setTheoricalTourOrder($line['N'])
                     ->setTheoricalTour($tour)
                     ->setTheoricalSlotStart(\DateTime::createFromFormat('H:i',$slotStart))
                     ->setTheoricalSlotEnd(\DateTime::createFromFormat('H:i',$slotEnd))
                     ->setTheoricalHour(\DateTime::createFromFormat('H:i',$line['AC']))
                     ;
               
               if (!$shipment->hasSlots())
                   $shipment->addSlot($slot);
               
               list($useless,$senderCode,$senderName)=explode('-',$line['D']);
               
               $shipperAccount=$this->getShipperAccountRepository()->resolveByCode($senderCode,$senderName);
               $shipment->setShipperAccount($shipperAccount);
                       
               $this->em->persist($shipment);
               $this->em->flush();
               
               return $output;
            }
        
            protected function getActionName() {
                return 'Excels liste camionage après routeur';
            }
}
