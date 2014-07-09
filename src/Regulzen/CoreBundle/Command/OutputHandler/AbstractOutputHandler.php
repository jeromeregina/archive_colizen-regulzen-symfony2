<?php
namespace Regulzen\CoreBundle\Command\OutputHandler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractOutputHandler
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

    /**
     *
     * @param  \Symfony\Component\Console\Output\OutputInterface        $output
     * @return \Regulzen\CoreBundle\Command\OutputHandler\OutputHandler
     */
    public function setCommandOutput(OutputInterface $output)
    {
       $this->output=$output;

       return $this;
    }
    /**
     *
     * @return boolean
     */
    public function hasCommandOutput()
    {
        return ($this->output instanceof OutputInterface);
    }
}
