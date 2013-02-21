<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 2/21/13
 * Time: 1:33 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Localuri\LocalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Localuri\LocalBundle\Repository\LocalRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="lcl_local")
 */
class Local
{
    /**
     * @var The id of the record
     *
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    ////////////////////////////////OWNER SPECIFIC DATA////////////////////////////////////////////
    /**
     * @var The name of the restaurant
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var The description - short presentation
     *
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var The owner of the restaurant
     *
     * @ORM\ManyToOne(targetEntity="Localuri\UserBundle\Entity\User", cascade={"all"}, fetch="EAGER", inversedBy="locals")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $owner;

    /**
     * @var The image file fo the restaurant
     *
     * @ORM\OneToOne(targetEntity="Localuri\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var The address
     *
     * todo: setup the relation to address
     */
    protected $address;

    /**
     * @var Categories of local
     *
     * @ORM\ManyToMany(targetEntity="Localuri\DictionaryBundle\Entity\Category", inversedBy="locals")
     * @ORM\JoinTable(name="local_category",
     *      joinColumns={@ORM\JoinColumn(name="local_id", referencedColumnName="id", onDelete="cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="cascade")}
     *      )
     */
    protected $categories;

    /**
     * @var The specifics of the local
     *
     * @ORM\ManyToMany(targetEntity="Localuri\DictionaryBundle\Entity\Specific", inversedBy="locals")
     * @ORM\JoinTable(name="local_specific",
     *      joinColumns={@ORM\JoinColumn(name="local_id", referencedColumnName="id", onDelete="cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="specific_id", referencedColumnName="id", onDelete="cascade")}
     *      )
     */
    protected $specifics;

    ////////////////////////////////END OWNER SPECIFIC DATA/////////////////////////////////////////

    ////////////////////////////////USER SPECIFIC DATA////////////////////////////////////////////
    /**
     * @var Uploaded pictures of local
     *
     * todo: setup the relation with media
     */
    protected $pictures;

    /**
     * @var Tags of local
     *
     * todo: setup m:n relation with dictionary (type=tags)
     */
    protected $tags;

    /**
     * @var Users' comments relative to the local
     *
     * todo: setup the relation with the comments
     */
    protected $comments;

    /**
     * @var users' ratings relative to the local
     *
     * todo: setup the relation with the ratings
     */
    protected $ratings;

    /**
     * @var average rating
     *
     * @ORM\Column(type="decimal", precision=3, scale=2, nullable=false)
     */
    protected $average_rating;
    ////////////////////////////////END USER SPECIFIC DATA/////////////////////////////////////////

    /**
     * @var Creation date
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @var Last update date
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated_at;

    /**
     * @ORM\PrePersist
     */
    public function prePersistFunction(){
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->average_rating = 0;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdateFunction(){
        $this->updated_at = new \DateTime();
    }
}
