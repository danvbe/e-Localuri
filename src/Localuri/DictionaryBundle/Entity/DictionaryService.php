<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danvbe
 * Date: 1/20/13
 * Time: 9:19 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Localuri\DictionaryBundle\Entity;

class DictionaryService
{

    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em){
        $this->em = $em;
    }

    public function getArrayValues($type = null){
        return $this->em->getRepository('LocaluriDictionaryBundle:Dictionary')->getArrayValues($type);
    }

    public function getDictionary($key , $type = null , $date = null){
        return $this->em->getRepository('LocaluriDictionaryBundle:Dictionary')->getDictionary($key,$type,$date);
    }
}
