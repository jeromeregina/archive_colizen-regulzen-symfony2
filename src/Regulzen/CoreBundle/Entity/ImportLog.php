<?php

namespace Regulzen\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ImportLog
 *
 * @ORM\Table(name="TBL_import_log")
 * @ORM\Entity(repositoryClass="Regulzen\CoreBundle\Repository\ImportLog")
 */
class ImportLog
{
    const MESSAGE_LEVEL_ACTION = 1;
    const MESSAGE_LEVEL_FILE = 2;
    const MESSAGE_LEVEL_SHIPMENT = 3;
    const MESSAGE_LEVEL_PARCEL = 4;

    public static $levelLabels=array(
        self::MESSAGE_LEVEL_ACTION => 'regulzen.import_log.level.action',
        self::MESSAGE_LEVEL_FILE => 'regulzen.import_log.level.file',
        self::MESSAGE_LEVEL_SHIPMENT => 'regulzen.import_log.level.shipment',
        self::MESSAGE_LEVEL_PARCEL => 'regulzen.import_log.level.parcel'
    );
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
     * @ORM\Column(name="IMPRT_message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPRT_cargopass", type="string", length=25, nullable=true)
     */
    private $cargopass;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPRT_level", type="integer", nullable=false)
     */
    private $level;

    /**
     *
     * @var boolean
     *
     * @ORM\Column(name="IMPRT_is_error", type="boolean", length=20, nullable=false, options={"default" = false})
     */
    private $isError = false;
    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="IMPRT_date", type="datetime")
     */
    private $date;
    /**
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     *
     * @param  string                                $message
     * @return \Regulzen\CoreBundle\Entity\ImportLog
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
    /**
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }
    public function getLevelLabel()
    {
        return self::$levelLabels[$this->level];
    }
    /**
     *
     * @param  integer                               $level
     * @return \Regulzen\CoreBundle\Entity\ImportLog
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }
    /**
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     *
     * @param  \DateTime                             $date
     * @return \Regulzen\CoreBundle\Entity\ImportLog
     *
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set isError
     *
     * @param  boolean   $isError
     * @return ImportLog
     */
    public function setIsError($isError)
    {
        $this->isError = (bool) $isError;

        return $this;
    }

    /**
     * Get isError
     *
     * @return boolean
     */
    public function getIsError()
    {
        return (bool) $this->isError;
    }

    /**
     * Set cargopass
     *
     * @param  string    $cargopass
     * @return ImportLog
     */
    public function setCargopass($cargopass = null)
    {
        $this->cargopass = $cargopass;

        return $this;
    }

    /**
     * Get cargopass
     *
     * @return string
     */
    public function getCargopass()
    {
        return $this->cargopass;
    }
}
