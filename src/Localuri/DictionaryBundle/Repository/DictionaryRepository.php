<?php

namespace Localuri\DictionaryBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DictionaryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DictionaryRepository extends EntityRepository
{
    /**
     * Returns an array (pair key=>value) of records with type=$type from the dictionary table
     *
     * @param null $type
     * @return array
     */
    public function getArrayValues($type = null){
        $q = $this->createQueryBuilder('d')
            ->select('d');
        if(null === $type)
            $q->where('d.type is null')
                ->andWhere('d.expired_at is null or d.expired_at <= :now')
                ->orderBy('d.value')
                ->setParameters(array('now'=> new \DateTime()));
        else
            $q->where('d.type = :type')
                ->andWhere('d.expired_at is null or d.expired_at <= :now')
                ->orderBy('d.value')
                ->setParameters(array('type'=>$type,'now'=> new \DateTime()));

        $array = array();
        foreach($q->getQuery()->execute() as $dict)
            $array[$dict->getKey()] = $dict->getValue();

        return $array;
    }

    /**
     * Returns a dictionary record based on $type, $key and the date when it was saved
     * @param $key
     * @param null $type
     * @param null $date
     * @return mixed
     */
    public function getDictionary($key , $type = null , $date = null){
        $q = $this->createQueryBuilder('d')
            ->select('d');
        if($type)
            $q->where('d.type = :$type')
                ->setParameter('type',$type);
        else $q->where('d.type is null');

        if($date)
            $q->andWhere('d.expired_at > :date or d.expired_at is null')
                ->setParameter('date',$date);

            $q->orderBy('d.expired_at');

        return $q->fetchOne();
    }

}