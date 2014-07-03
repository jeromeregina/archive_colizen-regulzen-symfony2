<?php

namespace Colizen\AdminBundle\Command\OutputHandler;

use Colizen\AdminBundle\Command\OutputHandler\AbstractOutputHandler;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Colizen\AdminBundle\Entity\ImportLog;

/**
 *  permet l'écriture simultané vers la ligne de commande & la table ImportLog
 */
class OutputHandler extends AbstractOutputHandler
{

    public function write($message, $level=ImportLog::MESSAGE_LEVEL_FILE, $isError=false, $cargopass=null)
    {
        if ($this->hasCommandOutput())
            $this->output->writeln($message);
        
        $log = new ImportLog();
        $log->setLevel($level)
            ->setMessage($message)
            ->setIsError($isError)
            ->setCargopass($cargopass);
        
        $this->em->persist($log);
        $this->em->flush();
    }
    
}