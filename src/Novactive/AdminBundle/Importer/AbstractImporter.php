<?php
namespace Novactive\AdminBundle\Importer;

use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\ORM\EntityManager;

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
    protected function findFiles(){
        return $this->finder->files()->in($this->sourceDirectory)->name($this->filenamePattern);
    }
    abstract public function execute();
    abstract protected function persistLine($line);
}
