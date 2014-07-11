<?php
namespace Regulzen\CoreBundle\Importer;

use Liuggio\ExcelBundle\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Regulzen\CoreBundle\Command\OutputHandler\OutputHandler;
use Regulzen\CoreBundle\Entity\Shipment;
use Regulzen\CoreBundle\Entity\DeliveryAddress;
use Regulzen\CoreBundle\Entity\Slot;
use Regulzen\CoreBundle\Entity\ImportLog;
use \Swift_Mailer;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Regulzen\CoreBundle\Importer\Exception\NotFoundException;

class TourPlanning extends AbstractImporter
{
    /**
     *
     * @var Factory
     */
    protected $phpExcel;

    public function __construct(EntityManagerInterface $em, $sourceDirectory, $filenamePattern, Swift_Mailer $mailer, TimedTwigEngine $templating, $mailTemplate, Factory $phpExcel)
    {
        $this->phpExcel=$phpExcel;
        parent::__construct($em, $sourceDirectory, $filenamePattern, $mailer, $templating,$mailTemplate);
    }

    /**
     *
     * @param  SplFileInfo $file (or string for filename)
     * @return array
     */
    protected function getLinesFromFile(SplFileInfo $file)
    {
        $isftp=(substr($file->getPath(),0,3)=='ftp');
        /** si le fichier est sur un ftp, stocker dans un fichier temporaire pour phpexcel **/
        if ($isftp) {
            $filename = tempnam("/tmp", "apres_routeur");
            $handle = fopen($filename, "w");
            fwrite($handle, $file->getContents());
            fclose($handle);
        } else {
            $filename = $file->getPathname();

        }
        $peo=$this->phpExcel->createPHPExcelObject($filename);
        $sheetData=$peo->getActiveSheet()->toArray(null,true,true,true);
        // suppression de la ligne d'entête (meilleure solution?)
        array_shift( $sheetData);
        if ($isftp)
            unlink($filename);

        return $sheetData;
    }
    const CARGOPASS='C';
    const CUSTOMER_CODE='D';
    const SITE_CODE='L';
    const SHIPPING_DATE='F';
    const SHIPMENT_WEIGHT='G';
    const PARCEL_QUANTITY='H';
    const SHIPMENT_PRIORITY='K';
    const TOUR_CODE='M';
    const TOUR_POSITION='N';
    const TOUR_DATE='O';
    const SLOT='P';
    const ADDRESS_REMARK='R';
    const ADDRESS_COUNTRY='S';
    const ADDRESS_ZIPCODE='T';
    const ADDRESS_CITY='U';
    const ADDRESS='V';
    const ADDRESS_NAME='W';
    const TELEPHONE='X';
    const EMAIL='Y';
    const LATITUDE='Z';
    const LONGITUDE='AA';
    const THEORICAL_HOUR='AC';
/**
    * C -> cargopass -> Shipment.cargopass
    * D -> code client -> Shipment.shipper_id (ShipperAccount?)
    * xxx E -> code agence expediteur -> Shipment.Site.CodeImtech ou Shipment.Site.Number
    * F -> date d'expedition -> Shipment.creationDate (?)
    * G -> poids -> Shipment.weight
    * H -> nombre de colis -> Shipment.parcelQuantity
    * K -> priorité de la livraison (?)
    * L -> code agence -> Shipment.Site.Number
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
    protected function persistLine($line,$lineid,SplFileInfo $file,OutputHandler $output = null)
    {
        if ($output instanceof OutputHandler) {
            $output->write('importing "'.$line[self::CARGOPASS].'" from file "'.$file->getFilename().'"',$this->getLineLevel(), false, $line[self::CARGOPASS]);
            }
               $shipment= $this->getShipmentRepository()->resolveByCargopass($line[self::CARGOPASS]);
               try {
                    $site= $this->getSiteRepository()->findOneByAnyCode($line[self::SITE_CODE]);
               } catch (\Doctrine\ORM\NoResultException $e) {
                   throw new NotFoundException('aborting import of "'.$line[self::CARGOPASS].'" from "'.$file->getFilename().'": site with code "'.$line[self::SITE_CODE]."' has not been found");
               }
               $shipment->setCargopass($line[self::CARGOPASS])
                       ->setDeliveryDate(\DateTime::createFromFormat('d.m.Y',$line[self::SHIPPING_DATE]))
                       ->setParcelQuantity(($line[self::PARCEL_QUANTITY]==0)?1:$line[self::PARCEL_QUANTITY])
                       ->setSite($site)
                       ->setWeight($line[self::SHIPMENT_WEIGHT])
                       ->setPriority(($line[self::SHIPMENT_PRIORITY]=='<?>')?null:$line[self::SHIPMENT_PRIORITY])
                       ;

               $deliveryAddress=($shipment->hasDeliveryAddress())?$shipment->getDeliveryAddress():new DeliveryAddress();


               $deliveryAddress
                       ->setAddress($line[self::ADDRESS])
                       ->setAdditionalInformations(($line[self::ADDRESS_REMARK]=='<?>')?null:$line[self::ADDRESS_REMARK])
                       ->setCountry($line[self::ADDRESS_COUNTRY])
                       ->setZipcode($line[self::ADDRESS_ZIPCODE])
                       ->setCity($line[self::ADDRESS_CITY])
                       ->setName($line[self::ADDRESS_NAME])
                       ->setTelephone(($line[self::TELEPHONE]=='<?>')?null:preg_replace('/[^0-9+]/', '', $line[self::TELEPHONE]))
                       ->setEmail(($line[self::EMAIL]=='<?>')?null:$line[self::EMAIL])
                       ->setLatitude($line[self::LATITUDE])
                       ->setLongitude($line[self::LONGITUDE])
                       ->setShipment($shipment)
                       ;

               $shipment->setDeliveryAddress($deliveryAddress);

               $tour = $this->resolveTour($line[self::TOUR_CODE], \DateTime::createFromFormat('[d.m.Y]',$line[self::TOUR_DATE]), $site, $file->getFilename(), $line[self::CARGOPASS]);

               $slot = ($shipment->getLastSlot() instanceof Slot)?$shipment->getLastSlot():new Slot();

               list($slotStart,$slotEnd)=explode('-',trim($line[self::SLOT],'[]'));

               $slot->setTheoricalTourOrder($line[self::TOUR_POSITION])
                     ->setTheoricalTour($tour)
                     ->setTheoricalSlotStart(\DateTime::createFromFormat('H:i',$slotStart))
                     ->setTheoricalSlotEnd(\DateTime::createFromFormat('H:i',$slotEnd))
                     ->setTheoricalHour(\DateTime::createFromFormat('H:i',$line[self::THEORICAL_HOUR]))
                     ;

               if (!$shipment->hasSlots())
                   $shipment->addSlot($slot);

               list($useless,$senderCode,$senderName)=explode('-',$line[self::CUSTOMER_CODE]);

               $shipperAccount=$this->getShipperAccountRepository()->resolveByCode($senderCode,$senderName);

                /** ajout à l'email en cour: "un shipper_account à été créé" **/
                if ($shipperAccount->getId()==null) {
                    $this->em->persist($shipperAccount);
                    $this->em->flush();
                    $this->addEmailLine($file->getFilename(), $line[self::CARGOPASS], 'shipper_account', $shipperAccount->getId());
               }
               $shipment->setShipperAccount($shipperAccount);

               $this->em->persist($shipment);
               $this->em->flush();

            }

            protected function getActionName()
            {
                return 'Excels liste camionage après routeur';
            }
            protected function getLineLevel()
            {
                return ImportLog::MESSAGE_LEVEL_SHIPMENT;
            }
}
