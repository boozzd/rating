<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Columndata
 *
 * @ORM\Table(name="column_data")
 * @ORM\Entity(repositoryClass="Admin\Repository\ColumndataRepository")
 */
class Columndata
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

    const TYPE_DEGREE = "degree";
    const TYPE_POSITION = "position";
    const TYPE_RANK = "rank";
    const TYPE_RATE = "rate";
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=false, unique=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isActive = 1;


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
     * @return Columndata
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
     * Set type
     *
     * @param string $type
     * @return Columndata
     */
    public function setType($type)
    {
        if (!in_array($type, array(self::TYPE_DEGREE, self::TYPE_POSITION, self::TYPE_RANK, self::TYPE_RATE))) {
            throw new \InvalidArgumentException("Invalid type");
        }
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Columndata
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
     * Get type name
     *
     * @return string
     */
    public function getTypeName(){
        $name = '';
        switch($this->type){
            case 'rate':
                $name = 'ставка';
                break;
            case 'position':
                $name = 'должность';
                break;
            case 'rank':
                $name = 'ученое звание';
                break;
            case 'degree':
                $name = 'научная степень';
                break;
        }
        return $name;
    }
}
