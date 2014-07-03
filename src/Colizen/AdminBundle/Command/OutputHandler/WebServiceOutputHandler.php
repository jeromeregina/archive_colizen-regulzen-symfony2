<?php

namespace Colizen\AdminBundle\Command\OutputHandler;

use Colizen\AdminBundle\Command\OutputHandler\AbstractOutputHandler;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Colizen\AdminBundle\Entity\ImportWebServiceLog;

/**
 *  permet l'écriture simultané vers la ligne de commande & la table ImportWebserviceLog
 */
class WebServiceOutputHandler extends AbstractOutputHandler
{

    public function write($message, $isError=false)
    {
        if ($this->hasCommandOutput())
            $this->output->writeln($message);
        
        $log = new ImportWebServiceLog();
        $log
            ->setMessage($message)
            ->setIsError($isError);
        
        $this->em->persist($log);
        $this->em->flush();
    }
    
}