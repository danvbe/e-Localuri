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

    public function getQBChoices($type = null){
        return $this->em->getRepository('LocaluriDictionaryBundle:Dictionary')->getQBChoices($type);
    }

    public function getDictionary($id ){
        return $this->em->getRepository('LocaluriDictionaryBundle:Dictionary')->getDictionary($id);
    }
}
