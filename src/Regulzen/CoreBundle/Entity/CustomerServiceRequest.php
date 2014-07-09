<?php

namespace Regulzen\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblCustomerServiceRequest
 *
 * @ORM\Table(name="TBL_customer_service_request")
 * @ORM\Entity(repositoryClass="Regulzen\CoreBundle\Repository\CustomerServiceRequest")
 */
class CustomerServiceRequest
{
    const REQUEST_STATUS_WAITING = 1;
    const REQUEST_STATUS_ACCEPTED = 2;
    const REQUEST_STATUS_REFUSED = 3;

    const REQUEST_TYPE_CANCEL = 1;
    const REQUEST_TYPE_UPDATE = 2;

    public static $statusLabels = array(
        self::REQUEST_STATUS_WAITING => 'regulzen.customer_service_request.status.waiting',
        self::REQUEST_STATUS_ACCEPTED => 'regulzen.customer_service_request.status.accepted',
        self::REQUEST_STATUS_REFUSED => 'regulzen.customer_service_request.status.refused'
    );

    public static $typeLabels = array(
        self::REQUEST_TYPE_CANCEL => 'regulzen.customer_service_request.type.cancel',
        self::REQUEST_TYPE_UPDATE => 'regulzen.customer_service_request.type.update',
    );

    /**
	 * @var integer
	 *
	 * @ORM\Column(name="CSREQ_id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
    private $id;

    /**
	 * @var User
	 *
	 * @Gedmo\Blameable(on="create")
	 * @ORM\ManyToOne(targetEntity="\Regulzen\UserBundle\Entity\User")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="USR_id", referencedColumnName="USR_id", nullable=true)
	 * })
	 */
    private $user;

    /**
	 * @var \DateTime $created
	 *
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(name="CSREQ_created", type="datetime")
	 */
    private $created;

    /**
	 * @var integer
	 *
	 * @ORM\Column(name="CSREQ_status", type="integer")
	 */
    private $status;

    /**
	 * @var string
	 *
	 * @ORM\Column(name="CSREQ_desc", type="string", length=255)
	 */
    private $desc;

    /**
	 * @var integer
	 *
	 * @ORM\Column(name="CSREQ_type", type="integer")
	 */
    private $type;

    /**
	 * @var string
	 *
	 * @ORM\Column(name="CSREQ_cargopass", type="string", length=8, nullable=false)
	 */
    private $cargopass;

    /**
	 * @var integer
	 *
	 * @ORM\Column(name="CSREQ_tourcode", type="integer", nullable=false)
	 */
    private $tourcode;

    /**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="CSREQ_starttime", type="datetime")
	 */
    private $startTime;

    /**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="CSREQ_endtime", type="datetime")
	 */
    private $endTime;

    /**
	 * @return \DateTime
	 */
    public function getCreated()
    {
        return $this->created;
    }

    /**
	 * @param \DateTime $created
	 */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
	 * @return string
	 */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
	 * @param string $desc
	 */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
	 * @return int
	 */
    public function getId()
    {
        return $this->id;
    }

    /**
	 * @param int $id
	 */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
	 * @return User
	 */
    public function getUser()
    {
        return $this->user;
    }

    /**
	 * @param User $user
	 */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
	 * @return int
	 */
    public function getStatus()
    {
        return $this->status;
    }
    /**
	 * @return string
	 */
    public function getStatusLabel()
    {
        return self::$statusLabels[$this->status];
    }

    /**
	 * @param int $status
	 */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
	 * @return int
	 */
    public function getType()
    {
        return $this->type;
    }
    /**
	 * @return string
	 */
    public function getTypeLabel()
    {
        return self::$typeLabels[$this->type];
    }

    /**
	 * @param int $type
	 */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set cargopass
     *
     * @param  string                 $cargopass
     * @return CustomerServiceRequest
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
     * Set tourcode
     *
     * @param  integer                $tourcode
     * @return CustomerServiceRequest
     */
    public function setTourcode($tourcode)
    {
        $this->tourcode = $tourcode;

        return $this;
    }

    /**
     * Get tourcode
     *
     * @return integer
     */
    public function getTourcode()
    {
        return $this->tourcode;
    }

    /**
     * Set startTime
     *
     * @param  \DateTime              $startTime
     * @return CustomerServiceRequest
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param  \DateTime              $endTime
     * @return CustomerServiceRequest
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }
}
