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
    /**
     * execute file imports, writes logs to OutputHandler if not null
     * 
     * @param \Novactive\AdminBundle\Command\OutputHandler\OutputHandler $output
     * @throws \Novactive\AdminBundle\Importer\Exception
     */
     public function execute(OutputHandler $output=null) {
        if ($output instanceof OutputHandler){
            $output->write('Import started : '.$this->getActionName(), ImportLog::MESSAGE_LEVEL_ACTION);
        }
        foreach ($this->findFiles() as $file){
            /* @var $file SplFileInfo */
                $lc=0;
            foreach ($this->getLinesFromFile($file) as $line){
                try {
                    $this->persistLine($line,$file,$output);
                } catch(\Exception $e){
                    if ($output instanceof OutputHandler){
                        $output->write('Error on '.$file->getFilename().', line '.$lc.' : '.$e->getMessage(), ImportLog::MESSAGE_LEVEL_LINE);
                    } else {
                        throw $e;
                    }
                }
                $lc++;
            }
        }
    }
    
    protected function findFiles(){
        return $this->finder->files()->in($this->sourceDirectory)->name($this->filenamePattern);
    }
    
    abstract protected function persistLine($line,SplFileInfo $file,  OutputHandler $output = null);
    abstract protected function getLinesFromFile(SplFileInfo $file);
    abstract protected function getActionName();
    /**
     * 
     * @return \Novactive\AdminBundle\Repository\Shipment
     */
    protected function getShipmentRepository(){
       return $this->em->getRepository('NovactiveAdminBundle:Shipment');
    }
    /**
     * 
     * @return \Novactive\AdminBundle\Repository\Parcel
     */
    protected function getParcelRepository(){
       return $this->em->getRepository('NovactiveAdminBundle:Parcel');
    }
    /**
     * 
     * @return \Novactive\AdminBundle\Repository\Sender
     */
    protected function getSenderRepository(){
       return $this->em->getRepository('NovactiveAdminBundle:Sender');
    }
    /**
     * 
     * @return \Novactive\AdminBundle\Repository\Site
     */
    protected function getSiteRepository(){
       return $this->em->getRepository('NovactiveAdminBundle:Site');
    }
}
