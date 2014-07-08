<?php

namespace Colizen\AdminBundle\Importer;

use Symfony\Component\Finder\SplFileInfo;
use Colizen\AdminBundle\Command\OutputHandler\OutputHandler;
use Colizen\AdminBundle\Entity\Parcel;
use Colizen\AdminBundle\Importer\Exception\NotFoundException;
use Colizen\AdminBundle\Entity\Slot;
use Colizen\AdminBundle\Entity\ImportLog;

class ParcelDetails extends AbstractImporter
{
    const SITE_CODE = 0;
    const TOUR_CODE = 1;
    const PLANIFIED_DATE = 2;
    const CARGOPASS_PARCEL = 4;
    const CARGOPASS_SHIPMENT = 13;
    const SHIPPING_HOUR = 5;
    const DELIVERY_HOUR = 8;
    const SLOT = 9;
    const TOUR_POSITION = 12;

    /**
     * ligne avec des informations séparées par des |
     *   0 -> Code agence de distribution      -> xxx            -> 750
     *   1 -> Code tournée                     -> yyy            -> 310
     *   2 -> Date planifiée de la livraison   -> JJ.MM.AAAA
     *   4 -> Cargopass 15 chiffres            -> xxxyyy123456789
     *   5 -> Heure de mise en tournée         -> HH:HH
     *   8 -> Heure théorique de livraison     -> HH:HH
     *   9 -> Créneau de livraison prévue      -> HH:HH/HH:HH
     *  12 -> Position du colis dans la tournée
     *  13 -> Numéro d'expédition              -> xxxyyy123456789
     *
     * @param string $line
     */
    protected function persistLine($line, $lineid, SplFileInfo $file, OutputHandler $output = null)
    {
        if ($output instanceof OutputHandler) {
            $output->write('importing line "' . $lineid . '" from file "' . $file->getFilename() . '"',  $this->getLineLevel(), false, $line[self::CARGOPASS_PARCEL]);
        }
        $array = explode('|', $line);

        $parcel = $this->getParcelRepository()->resolveByCargopass($array[self::CARGOPASS_PARCEL]);

        try {
            $shipment = $this->getShipmentRepository()->findOneByFifteenIntegersFormatCargopass($array[self::CARGOPASS_SHIPMENT]);
        } catch (\Doctrine\ORM\NoResultException $e) {
            throw new NotFoundException('aborting import of line "' . $lineid . '" from "' . $file->getFilename() . '": shipment with code  "' . $array[self::CARGOPASS_SHIPMENT] . "' has not been found");
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            throw new NotFoundException('aborting import of line "' . $lineid . '" from "' . $file->getFilename() . '": multiple shipments correspond to code "' . $array[self::CARGOPASS_SHIPMENT] . "'");
        }
        $parcel->setShipment($shipment);

        $tour = $this->resolveTour($line[self::TOUR_CODE], \DateTime::createFromFormat('d.m.Y', $line[self::PLANIFIED_DATE]), $shipment->getSite(), $file->getFilename(), $array[self::CARGOPASS_PARCEL]);

        $slot = ($shipment->getLastSlot() instanceof Slot) ? $shipment->getLastSlot() : new Slot();

        list($slotStart, $slotEnd) = explode('/', $line[self::SLOT]);

        $slot->setRealTourOrder($line[self::TOUR_POSITION])
                ->setRealTour($tour)
                ->setRealSlotStart(\DateTime::createFromFormat('H:i', $slotStart))
                ->setRealSlotEnd(\DateTime::createFromFormat('H:i', $slotEnd))
                ->setRealHour(\DateTime::createFromFormat('H:i', $line[self::DELIVERY_HOUR]))
        ;

        if (!$shipment->hasSlots())
            $shipment->addSlot($slot);

        $this->em->persist($parcel);
        $this->em->flush();
    }

    /**
     *
     * @param SplFileInfo $file
     */
    protected function getLinesFromFile(SplFileInfo $file)
    {
        $ar = explode("\r\n", trim($file->getContents()));

        return $ar;
    }

    protected function getActionName()
    {
        return 'Text fichier planification imtech';
    }

    /**
     *
     * @return \Colizen\AdminBundle\Repository\Parcel
     */
    protected function getParcelRepository()
    {
        return $this->em->getRepository('ColizenAdminBundle:Parcel');
    }
    protected function getLineLevel()
    {
                return ImportLog::MESSAGE_LEVEL_PARCEL;
            }
}
