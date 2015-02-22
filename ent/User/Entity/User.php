<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="username", type="string", length=255, precision=0, scale=0, nullable=true, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, precision=0, scale=0, nullable=false, unique=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="ucode", type="string", length=128, precision=0, scale=0, nullable=false, unique=false)
     */
    private $ucode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User\Entity\Role")
     * @ORM\JoinTable(name="user_role_linker",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
     *   }
     * )
     */
    private $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set ucode
     *
     * @param string $ucode
     * @return User
     */
    public function setUcode($ucode)
    {
        $this->ucode = $ucode;

        return $this;
    }

    /**
     * Get ucode
     *
     * @return string 
     */
    public function getUcode()
    {
        return $this->ucode;
    }

    /**
     * Add roles
     *
     * @param \User\Entity\Role $roles
     * @return User
     */
    public function addRole(\User\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \User\Entity\Role $roles
     */
    public function removeRole(\User\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="upcode", type="string", length=128, precision=0, scale=0, nullable=false, unique=false)
     */
    private $upcode;


    /**
     * Set upcode
     *
     * @param string $upcode
     * @return User
     */
    public function setUpcode($upcode)
    {
        $this->upcode = $upcode;

        return $this;
    }

    /**
     * Get upcode
     *
     * @return string 
     */
    public function getUpcode()
    {
        return $this->upcode;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="secondname", type="string", length=128, precision=0, scale=0, nullable=true, unique=false)
     */
    private $secondname;


    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set secondname
     *
     * @param string $secondname
     * @return User
     */
    public function setSecondname($secondname)
    {
        $this->secondname = $secondname;

        return $this;
    }

    /**
     * Get secondname
     *
     * @return string 
     */
    public function getSecondname()
    {
        return $this->secondname;
    }
    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var boolean
     */
    private $isDelete;


    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return User
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean 
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }
    /**
     * @var \User\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="User\Entity\Role", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $role;


    /**
     * Set role
     *
     * @param \User\Entity\Role $role
     * @return User
     */
    public function setRole(\User\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \User\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @var \Unit\Entity\Unit
     *
     * @ORM\ManyToOne(targetEntity="Unit\Entity\Unit", inversedBy="features")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $unit;


    /**
     * Set unit
     *
     * @param \Unit\Entity\Unit $unit
     * @return User
     */
    public function setUnit(\Unit\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \Unit\Entity\Unit 
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
