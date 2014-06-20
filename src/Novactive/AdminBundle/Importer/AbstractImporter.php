<?php
namespace Novactive\AdminBundle\Importer;

use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\ORM\EntityManager;
use Symfony\Component\Finder\SplFileInfo;

abstract class AbstractImporter {
    /**
     *
     * @var EntityManager
     */
    protected $em;
    protected $sourceDirectory;
    /**
     *
     * @var Finder
     */
    protected $finder;
    protected $filenamePattern;
    public function __construct(EntityManagerInterface $em, $sourceDirectory, $filenamePattern) {
        $this->em=$em;
        $this->sourceDirectory=$sourceDirectory;
        $this->filenamePattern=$filenamePattern;
        $this->finder=new Finder();
    }
     public function execute() {
        foreach ($this->findFiles() as $file){
            /* @var $file SplFileInfo */
            foreach ($this->getLinesFromFile($file) as $line){
                $this->persistLine($line);
            }
        }
    }
    
    protected function findFiles(){
        return $this->finder->files()->in($this->sourceDirectory)->name($this->filenamePattern);
    }
    
    abstract protected function persistLine($line);
    abstract protected function getLinesFromFile($file);
}
