<?php
namespace Novactive\AdminBundle\Importer;

use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\ORM\EntityManager;
use Symfony\Component\Finder\SplFileInfo;
use Novactive\AdminBundle\Command\OutputHandler\OutputHandler;
use Novactive\AdminBundle\Entity\ImportLog;

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
     public function execute(OutputHandler $output=null) {
        if ($output instanceof OutputHandler){
            $output->write('Import started : '.$this->getActionName(), ImportLog::MESSAGE_LEVEL_ACTION);
        }
        foreach ($this->findFiles() as $file){
            /* @var $file SplFileInfo */
            foreach ($this->getLinesFromFile($file) as $line){
                $this->persistLine($line,$file,$output);
            }
        }
    }
    
    protected function findFiles(){
        return $this->finder->files()->in($this->sourceDirectory)->name($this->filenamePattern);
    }
    
    abstract protected function persistLine($line,SplFileInfo $file,OutputHandler $output);
    abstract protected function getLinesFromFile(SplFileInfo $file);
    abstract protected function getActionName();
}
