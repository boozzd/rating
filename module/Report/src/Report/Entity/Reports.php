<?php

namespace Report\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Report
 *
 * @ORM\Table(name="reports")
 * @ORM\Entity(repositoryClass="Report\Repository\ReportsRepository")
 */
class Reports
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $note;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edit_date", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $editDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isActive = 1;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Columndata")
     * @ORM\JoinColumn(name="year_id", referencedColumnName="id")
     **/
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Columndata")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     **/
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Columndata")
     * @ORM\JoinColumn(name="degree_id", referencedColumnName="id")
     **/
    private $degree;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Columndata")
     * @ORM\JoinColumn(name="rank_id", referencedColumnName="id")
     **/
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Columndata")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id")
     **/
    private $rate;

    /**
     * @ORM\ManyToOne(targetEntity="User\Entity\User", inversedBy="reports")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;


    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Reports
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Reports
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Reports
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set editDate
     *
     * @param \DateTime $editDate
     * @return Reports
     */
    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;

        return $this;
    }

    /**
     * Get editDate
     *
     * @return \DateTime
     */
    public function getEditDate()
    {
        return $this->editDate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Reports
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set year
     *
     * @param \Admin\Entity\Columndata $year
     * @return Reports
     */
    public function setYear(\Admin\Entity\Columndata $year = null)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \Admin\Entity\Columndata
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set position
     *
     * @param \Admin\Entity\Columndata $position
     * @return Reports
     */
    public function setPosition(\Admin\Entity\Columndata $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \Admin\Entity\Columndata
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set degree
     *
     * @param \Admin\Entity\Columndata $degree
     * @return Reports
     */
    public function setDegree(\Admin\Entity\Columndata $degree = null)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return \Admin\Entity\Columndata
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set rank
     *
     * @param \Admin\Entity\Columndata $rank
     * @return Reports
     */
    public function setRank(\Admin\Entity\Columndata $rank = null)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return \Admin\Entity\Columndata
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set rate
     *
     * @param \Admin\Entity\Columndata $rate
     * @return Reports
     */
    public function setRate(\Admin\Entity\Columndata $rate = null)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return \Admin\Entity\Columndata
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set user
     *
     * @param \User\Entity\User $user
     * @return Reports
     */
    public function setUser(\User\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
