<?php
namespace Novactive\AdminBundle\Importer;

use Liuggio\ExcelBundle\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;

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

    public function execute() {
        foreach ($this->findFiles() as $file){
            /* @var $file SplFileInfo */
            foreach ($this->getLinesFromFile($file) as $line){
                $this->persistLine($line);
            }
        }
    }
    /**
     * 
     * @param SplFileInfo $file (or string for filename)
     * @return array
     */
    protected function getLinesFromFile($file){
        $peo=$this->phpExcel->createPHPExcelObject($file);
        $sheetData=$peo->getActiveSheet()->toArray(null,true,true,true);
        // suppression de la ligne d'entête (meilleure solution?)
        unset($sheetData[0]);
        return $sheetData;
    }
/**
 * C -> cargopass
 * D -> code client
 * E -> code agence expediteur
 * F -> date d'expedition
 * G -> poids
 * H -> nombre de colis
 * K -> priorité de la livraison (?)
 * L -> code agence
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
    protected function persistLine($line) {
        
    }


}
