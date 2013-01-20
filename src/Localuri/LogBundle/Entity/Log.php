<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/1/13
 * Time: 12:24 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Localuri\LogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Localuri\LogBundle\Repository\LogRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="lcl_log")
 */
class Log
{
    /**
     * @var \Doctrine\ORM\EntityManager $em
     */
    protected $em;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $operation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $ip;

    /**
     * The user might be stored by id, by name, by email, etc.
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $entity_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /** @ORM\Column(name="created_at", type="datetime") */
    protected $created_at;

    public function __construct(\Doctrine\ORM\EntityManager $em){
        $this->em = $em;
    }

    /** @ORM\PrePersist */
    public function prePersist()
    {
        $this->created_at = new \DateTime();
    }

    /**
     * Function to actually log the data
     * @param null $operation
     * @param null $ip
     * @param null $user
     * @param null $entity_name
     * @param null $description
     * @return bool
     */
    public function doLog($operation = null, $ip = null, $user = null, $entity_name = null, $description = null){
        $this->operation = $operation;
        $this->ip = $ip;
        $this->user = $user;
        $this->entity_name = $entity_name;
        $this->description = $description;

        $this->em->persist($this);
        $this->em->flush();
        return true;
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
     * Set operation
     *
     * @param string $operation
     * @return Log
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * Get operation
     *
     * @return string 
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Log
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set entity_name
     *
     * @param string $entityName
     * @return Log
     */
    public function setEntityName($entityName)
    {
        $this->entity_name = $entityName;
        return $this;
    }

    /**
     * Get entity_name
     *
     * @return string 
     */
    public function getEntityName()
    {
        return $this->entity_name;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Log
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
     * Set user
     *
     * @param string $user
     * @return Log
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
}