<?php

namespace Novactive\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this
            ->setName('regulzen:data:import')
            ->setDescription('Imports data from colizen');
    }
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->firstStep($output);
        
       
    }
    /**
     *  Import des fichiers excels de type "liste de camionage après routeur"
     * 
     * 
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function firstStep(OutputInterface $output){
        /* @var $logger \Symfony\Bridge\Monolog\Logger */
        $importer=$this->getContainer()->get('novactive_admin.importer.tour_planning');
        $oh=$this->getContainer()->get('novactive_admin.importer.output_handler')->setCommandOutput($output);
        $importer->execute($oh);
    }
    /**
     *  Import des fichiers txt de type "fichier planification"
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function secondStep(OutputInterface $output){
         $importer=$this->getContainer()->get('novactive_admin.importer.parcel_details');
         $oh=$this->getContainer()->get('novactive_admin.importer.output_handler')->setCommandOutput($output);
         $importer->execute($oh);
    }
}
