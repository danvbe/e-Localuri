<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/17/13
 * Time: 10:14 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Localuri\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Localuri\AddressBundle\Repository\AddressRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="lcl_address")
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="country_code", type="string", length=255, nullable=true) */
    protected $country_code;

    /** @ORM\Column(name="county_code", type="string", length=255, nullable=true) */
    protected $county_code;

    /** @ORM\Column(name="city", type="string", length=255, nullable=true) */
    protected $city;

    /** @ORM\Column(name="street", type="string", length=255, nullable=true) */
    protected $street;

    /** @ORM\Column(name="number", type="string", length=255, nullable=true) */
    protected $number;

    /** @ORM\Column(name="latitude", type="string", length=255, nullable=true) */
    protected $latitude;

    /** @ORM\Column(name="longitude", type="string", length=255, nullable=true) */
    protected $longitude;


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
     * Set country_code
     *
     * @param string $countryCode
     * @return Address
     */
    public function setCountryCode($countryCode)
    {
        $this->country_code = $countryCode;
        return $this;
    }

    /**
     * Get country_code
     *
     * @return string 
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Set county_code
     *
     * @param string $countyCode
     * @return Address
     */
    public function setCountyCode($countyCode)
    {
        $this->county_code = $countyCode;
        return $this;
    }

    /**
     * Get county_code
     *
     * @return string 
     */
    public function getCountyCode()
    {
        return $this->county_code;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Address
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Address
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}