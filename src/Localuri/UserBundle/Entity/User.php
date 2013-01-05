<?php
namespace Localuri\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Localuri\UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="lcl_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="created_at", type="datetime") */
    protected $created_at;

    /** @ORM\Column(name="updated_at", type="datetime") */
    protected $updated_at;

    /*
     * @ORM\OneToMany(targetEntity="Local", mappedBy="owner", cascade={"remove"})
     */
//    protected $locals;

    /*
     * @ORM\OneToMany(targetEntity="UserTelephone", mappedBy="user", cascade={"remove"})
     */
//    protected $telephones;

    /*
     * @ORM\OneToMany(targetEntity="UserAddress", mappedBy="user", cascade={"remove"})
     **/
//    protected  $addresses;

/*
    public function __construct()
    {
        //$this->logs = new ArrayCollection();
        //$this->telephones = new ArrayCollection();
        //$this->addresses = new ArrayCollection();
    }
*/

    /** @ORM\PrePersist */
    public function prePersist()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    /** @ORM\PreUpdate */
    public function preUpdate()
    {
        $this->updated_at = new \DateTime();
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
}