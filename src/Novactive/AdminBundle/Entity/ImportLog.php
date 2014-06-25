<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_import_log")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\ImportLog")
 */
class ImportLog
{
    const MESSAGE_LEVEL_ACTION = 1;
    const MESSAGE_LEVEL_FILE = 2;
    const MESSAGE_LEVEL_LINE = 3;

    /**
     * @var integer
     *
     * @ORM\Column(name="IMPRT_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPRT_message", type="string", length=255, nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPRT_level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="IMPRT_date", type="datetime")
     */
    private $date;

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(datetime $date)
    {
        $this->date = $date;

        return $this;
    }

}
