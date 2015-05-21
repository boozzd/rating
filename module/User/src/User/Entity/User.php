<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */
 
namespace User\Entity;

use BjyAuthorize\Provider\Role\ProviderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity(repositoryClass="User\Repository\UserRepository")
 * @ORM\Table(name="users")
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class User implements UserInterface, ProviderInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true,  length=255)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $displayName;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $lastname;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $secondname;

    /**
     * @var string
     * @ORM\Column(type="string", length=128)
     */
    protected $password;

    /**
     * @var int
     */
    protected $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="User\Entity\Role")
     * @ORM\JoinTable(name="user_role_linker",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="ucode", type="string", length=128, precision=0, scale=0, nullable=false, unique=false)
     */
    private $ucode;

    /**
     * @var string
     *
     * @ORM\Column(name="upcode", type="string", length=128, precision=0, scale=0, nullable=false, unique=false)
     */
    private $upcode;

    /**
     * @var boolean
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = 1;

    /**
     * @var boolean
     * @ORM\Column(name="is_delete", type="boolean")
     */
    private $isDelete = 0;

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
     * @ORM\OneToMany(targetEntity="Report\Entity\Reports", mappedBy="report")
     **/
    private $reports;

    /**
     * Initialies the roles variable.
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->reports = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     *
     * @return void
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param int $state
     *
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get role.
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles->getValues();
    }

    /**
     * Add a role to the user.
     *
     * @param Role $role
     *
     * @return void
     */
    public function addRole($role)
    {
        $this->roles[] = $role;
    }

    /**
     * Set roles.
     *
     * @param Roles array
     *
     * @return void
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
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

    /**
     * Get institute
     *
     * @return \Unit\Entity\Unit id
     */
    public function getInstitute()
    {
        if($this->getUnit() && $this->getUnit()->getParent()){
            return $this->getUnit()->getParent()->getId();
        }elseif( $this->getUnit()){
            return $this->getUnit()->getId();
        }else{
            return 0;
        }
    }

    /**
     * Get chair
     *
     * @return \Unit\Entity\Unit id
     */
    public function getChair()
    {
        $chair = $this->getUnit() && $this->getUnit()->getParent() ? $this->getUnit()->getId() : 0;
        return $chair;
    }

    /**
     * Add reports
     *
     * @param \Report\Entity\Reports $reports
     * @return User
     */
    public function addReports(\Report\Entity\Reports $reports)
    {
        $this->reports[] = $reports;

        return $this;
    }

    /**
     * Remove reports
     *
     * @param \Report\Entity\Reports $reports
     */
    public function removeReport(\Report\Entity\Reports $reports)
    {
        $this->reports->removeElement($reports);
    }

    /**
     * Get reports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReports()
    {
        return $this->reports;
    }
}
