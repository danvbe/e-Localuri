<?php
namespace Localuri\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
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
        $this->locals = new ArrayCollection();
        $this->telephones = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }
*/

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