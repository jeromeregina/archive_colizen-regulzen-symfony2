<?php

namespace Regulzen\CoreBundle\Command\OutputHandler;

use Regulzen\CoreBundle\Entity\ImportWebServiceLog;

/**
 *  permet l'écriture simultané vers la ligne de commande & la table ImportWebserviceLog
 */
class WebServiceOutputHandler extends AbstractOutputHandler
{

    public function write($message, $level = ImportWebServiceLog::MESSAGE_LEVEL_CALL, $isError=false, $cargopass=null,$status=null)
    {
        if ($this->hasCommandOutput())
            $this->output->writeln($message);

        $log = new ImportWebServiceLog();
        $log->setLevel($level)
            ->setMessage($message)
            ->setIsError($isError)
            ->setCargopass($cargopass)
            ->setStatusCode($status);

        $this->em->persist($log);
        $this->em->flush();
    }

}
