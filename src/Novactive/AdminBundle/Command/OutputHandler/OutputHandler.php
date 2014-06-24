<?php

namespace Novactive\AdminBundle\Command\OutputHandler;

use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Novactive\AdminBundle\Entity\ImportLog;
/**
 *  permet l'écriture simultané vers la ligne de commande & la table ImportLog
 */
class OutputHandler 
{

    /**
     *
     * @var EntityManager 
     */
    protected $em;
    /**
     * @var OutputInterface
     */
    protected $output;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function write($message, $level=ImportLog::MESSAGE_LEVEL_LINE)
    {
        if ($this->hasCommandOutput())
            $this->output->writeln($message);
        
        $log = new ImportLog();
        $log->setLevel($level)
            ->setMessage($message);
        
        $this->em->persist($log);
        $this->em->flush();
    }
    
    /**
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return \Novactive\AdminBundle\Command\OutputHandler\OutputHandler
     */
    public function setCommandOutput(OutputInterface $output){
       $this->output=$output;
       return $this;
    }
    /**
     * 
     * @return boolean
     */
    public function hasCommandOutput(){
        return ($this->output instanceof OutputInterface);
    }
}