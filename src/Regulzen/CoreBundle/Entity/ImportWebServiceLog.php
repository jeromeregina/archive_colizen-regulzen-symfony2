<?php

namespace Regulzen\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ImportWebServiceLog
 *
 * @ORM\Table(name="TBL_import_web_service_log")
 * @ORM\Entity(repositoryClass="Regulzen\CoreBundle\Repository\ImportWebServiceLog")
 */
class ImportWebServiceLog
{
    const MESSAGE_LEVEL_GLOBAL = 1;
    const MESSAGE_LEVEL_CALL = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="IMPRTWS_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPRTWS_message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPRTWS_level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPRTWS_cargopass", type="string", length=25, nullable=false)
     */
    private $cargopass;

     /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour")
     * @ORM\JoinColumn(name="TOUR_id", referencedColumnName="TOUR_id", nullable=true)
     */
    private $tour;

    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="STATUS_code", referencedColumnName="STATUS_code", nullable=true)
     */
    protected $status;

     /**
     * @var integer
     *
     * @ORM\Column(name="STATUS_code", type="integer", nullable=true)
     */
    protected $statusCode;

    /**
     *
     * @var boolean
     *
     * @ORM\Column(name="IMPRTWS_is_error", type="boolean", length=20, nullable=false, options={"default" = false})
     */
    private $isError = false;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="IMPRTWS_date", type="datetime")
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

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set cargopass
     *
     * @param  string              $cargopass
     * @return ImportWebServiceLog
     */
    public function setCargopass($cargopass)
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

    /**
     * Set isError
     *
     * @param  boolean             $isError
     * @return ImportWebServiceLog
     */
    public function setIsError($isError)
    {
        $this->isError = $isError;

        return $this;
    }

    /**
     * Get isError
     *
     * @return boolean
     */
    public function getIsError()
    {
        return $this->isError;
    }

    /**
     * Set tour
     *
     * @param  \Regulzen\CoreBundle\Entity\Tour $tour
     * @return ImportWebServiceLog
     */
    public function setTour(\Regulzen\CoreBundle\Entity\Tour $tour = null)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \Regulzen\CoreBundle\Entity\Tour
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Set status
     *
     * @param  \Regulzen\CoreBundle\Entity\Status $status
     * @return ImportWebServiceLog
     */
    public function setStatus(\Regulzen\CoreBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Regulzen\CoreBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set level
     *
     * @param  integer             $level
     * @return ImportWebServiceLog
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }
     /**
     * Set statusCode
     *
     * @param  integer $statusCode
     * @return Parcel
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get statusCode
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
