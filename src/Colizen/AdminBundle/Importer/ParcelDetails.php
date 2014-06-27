<?php
namespace Colizen\AdminBundle\Importer;

use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Finder\SplFileInfo;
use Colizen\AdminBundle\Command\OutputHandler\OutputHandler;

class ParcelDetails extends AbstractImporter {
    /**
     * ligne avec des informations séparées par des |
     *   0 -> Code agence
     *   1 -> Code tournée
     *   2 -> Date planifiée de la livraison : JJ.MM.AAAA
     *   3 -> 
     *   4 -> Cargopass 15 chiffres
     *   5 -> Heure de livraison planifié : HH:HH
     *   6 -> 
     *   7 ->
     *   8 -> 
     *   9 -> Créneau de livraison : HH:HH/HH:HH
     *  10 ->
     *  11 ->
     *  12 ->
     * 
     * @param string $line
     */
    protected function persistLine($line,SplFileInfo $file,OutputHandler $output = null) {
        $array=split('\|',$line);
        var_dump($array);die;
    }
/**
 * 
 * @param SplFileInfo $file
 */
    protected function getLinesFromFile(SplFileInfo $file) {
        $ar=split("\r\n",trim($file->getContents()));
       return $ar;
    }
    protected function getActionName() {
                return 'Text fichier planification imtech';
   }
}
