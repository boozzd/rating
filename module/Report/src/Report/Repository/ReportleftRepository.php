<?php

namespace Report\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ReportleftRepository
 * @package Report\Repository
 */
class ReportleftRepository extends EntityRepository
{
//    /**
//     * Get units
//     *
//     * @param null $parent Parent id, if get 0 return parent units
//     * @param $active
//     * @return \Unit\Entity\Unit
//     */
//    public function getUnits($parent = null, $active = true)
//    {
//        $querybuilder = $this->_em
//            ->getRepository($this->getEntityName())
//            ->createQueryBuilder('u')
//            ->where('u.isActive =:active')
//            ->setParameter('active',$active);
//
//        if($parent === 0 ){
//            $querybuilder->andWhere('u.parent IS NULL');
//        }elseif($parent){
//            $querybuilder->andWhere('u.parent  =:parent')
//                ->setParameter('parent', $parent);
//        }
//
//        $result = $querybuilder->getQuery();
//        return $result;
//    }
}