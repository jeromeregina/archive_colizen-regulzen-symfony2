<?php
namespace Colizen\AdminBundle\Importer;

use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Finder\SplFileInfo;
use Colizen\AdminBundle\Command\OutputHandler\OutputHandler;
use Colizen\AdminBundle\Entity\Parcel;

class ParcelDetails extends AbstractImporter {
    /**
     * ligne avec des informations séparées par des |
     *   0 -> Code agence de distribution      -> xxx            -> 750
     *   1 -> Code tournée                     -> yyy            -> 310
     *   2 -> Date planifiée de la livraison   -> JJ.MM.AAAA
     *   3  
     *   4 -> Cargopass 15 chiffres            -> xxxyyy123456789
     *   5 -> Heure de mise en tournée         -> HH:HH
     *   6  
     *   7 
     *   8 -> Heure théorique de livraison     -> HH:HH
     *   9 -> Créneau de livraison prévue      -> HH:HH/HH:HH
     *  10 
     *  11 
     *  12 -> Position du colis dans la tournée
     *  13 -> Numéro d'expédition              -> xxxyyy123456789
     * 
     * @param string $line
     */
    protected function persistLine($line,$lineid,SplFileInfo $file,OutputHandler $output = null) {
        if ($output instanceof OutputHandler)
         { 
         $output->write('importing line "'.$lineid.'" from file "'.$file->getFilename().'"');
         }
        $array=explode('|',$line);
        
        $parcel=$this->getParcelRepository()->resolveByCargopass($array[4]);
        if ($parcel->getId()==null){
            try {
            $shipment=$this->getShipmentRepository()->findOneByFifteenIntegersFormatCargopass($array[13]);
            } catch (\Doctrine\ORM\NoResultException $e){
                throw new NotFoundException('aborting import of "'.$lineid.'" from "'.$file->getFilename().'": shipment with code  "'.$array[13]."' has not been found");
            } catch (\Doctrine\ORM\NonUniqueResultException $e){
                throw new NotFoundException('aborting import of "'.$lineid.'" from "'.$file->getFilename().'": multiple shipments correspond to code "'.$array[13]."'");
            }
            $parcel->setShipment($shipment);
        }
    }
/**
 * 
 * @param SplFileInfo $file
 */
    protected function getLinesFromFile(SplFileInfo $file) {
        $ar=explode("\r\n",trim($file->getContents()));
       return $ar;
    }
    protected function getActionName() {
                return 'Text fichier planification imtech';
   }
    /**
     * 
     * @return \Colizen\AdminBundle\Repository\Parcel
     */
    protected function getParcelRepository(){
       return $this->em->getRepository('ColizenAdminBundle:Parcel');
    }
}
