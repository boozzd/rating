<?php

namespace Unit\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UnitRepository
 * @package Unit\Repository
 */
class UnitRepository extends EntityRepository
{
    /**
     * Get units
     *
     * @param null $parent Parent id, if get 0 return parent units
     * @param $active
     * @return \Unit\Entity\Unit
     */
    public function getUnits($parent = null, $active = true)
    {
        $querybuilder = $this->_em
            ->getRepository($this->getEntityName())
            ->createQueryBuilder('u')
            ->where('u.isActive =:active')
            ->setParameter('active',$active);

        if($parent === 0 ){
            $querybuilder->andWhere('u.parent IS NULL');
        }elseif($parent){
            $querybuilder->andWhere('u.parent  =:parent')
                ->setParameter('parent', $parent);
        }

        $result = $querybuilder->getQuery();
        return $result;
    }
    /**
     * Get array key => value
     *
     * @param $parent_id
     * @param $active
     * @return array
     */
    public function getUnitsArray($parent_id = null, $active = true)
    {
        $querybuilder = $this->_em
            ->getRepository($this->getEntityName())
            ->createQueryBuilder('u')
            ->where('u.isActive =:active')
            ->setParameter('active', $active);

        if($parent_id === 0){
            $querybuilder->andWhere('u.parent IS NULL');
        }elseif($parent_id){
            $querybuilder->andWhere('u.parent =:parent')
                ->setParameter('parent', $parent_id);
        }

        $res = $querybuilder->getQuery()->getArrayResult();

        $result = array();
        foreach($res as $r){
            $result[$r['id']] = $r['name'];
        }
        return $result;
    }
}