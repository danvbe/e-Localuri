<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 2/21/13
 * Time: 8:53 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Localuri\DictionaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Specific extends Dictionary
{
    /**
     * @ORM\ManyToMany(targetEntity="Localuri\LocalBundle\Entity\Local", mappedBy="categories")
     */
    protected $locals;
}
