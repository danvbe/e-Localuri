<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/20/13
 * Time: 3:16 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Localuri\DictionaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Localuri\DictionaryBundle\Repository\DictionaryRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="lcl_dictionary")
 */
class Dictionary
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="type_", type="string", length=255, nullable=true) */
    protected $type;

    /** @ORM\Column(name="key_", type="string", length=255, nullable=false) */
    protected $key;

    /** @ORM\Column(name="value_", type="string", length=255, nullable=false) */
    protected $value;

    /** @ORM\Column(name="description", type="text", nullable=true) */
    protected $description;

    /** @ORM\Column(name="created_at", type="datetime", nullable=false) */
    protected $created_at;

    /** @ORM\Column(name="updated_at", type="datetime", nullable=false) */
    protected $updated_at;

    /** @ORM\Column(name="expired_at", type="datetime", nullable=true) */
    protected $expired_at;

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



    //***************************************************//
    //----------------------GENERATED CODE---------------//
    //***************************************************//

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
     * Set type
     *
     * @param string $type
     * @return Dictionary
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get dictionary_type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return Dictionary
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Dictionary
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Dictionary
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     * @return Dictionary
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     * @return Dictionary
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set expired_at
     *
     * @param datetime $expiredAt
     * @return Dictionary
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expired_at = $expiredAt;
        return $this;
    }

    /**
     * Get expired_at
     *
     * @return datetime 
     */
    public function getExpiredAt()
    {
        return $this->expired_at;
    }
}