<?php

namespace Regulzen\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('regulzen:data:import')
            ->setDescription('Imports data from regulzen');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->firstStep($output);
        $this->secondStep($output);
        //$this->webserviceImport($output);

    }

    /**
     *  Import des fichiers excels de type "liste de camionage après routeur"
     *
     *
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function firstStep(OutputInterface $output)
    {
        $importer=$this->getContainer()->get('regulzen_core.importer.tour_planning');
        $importer->execute($this->getOutputHandler($output));
    }

    /**
     *  Import des fichiers txt de type "fichier planification"
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function secondStep(OutputInterface $output)
    {
        $importer=$this->getContainer()->get('regulzen_core.importer.parcel_details');
        $importer->execute($this->getOutputHandler($output));
    }

    protected function webserviceImport(OutputInterface $output)
    {
        $importer=$this->getContainer()->get('regulzen_core.importer.webservice');
        $importer->execute($this->getContainer()->get('regulzen_core.importer.webservice.output_handler')->setCommandOutput($output));
    }

    protected function getOutputHandler(OutputInterface $output)
    {
        return $this->getContainer()->get('regulzen_core.importer.output_handler')->setCommandOutput($output);
    }
}
