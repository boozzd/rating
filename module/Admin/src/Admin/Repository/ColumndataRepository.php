<?php

namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;

class ColumndataRepository extends EntityRepository
{
    /**
     * Get data by type
     *
     * @param $type string
     * @return array Admin\Entity\Columndata
     */
    public function getColumnDataByType($type)
    {
        $querybuilder = $this->_em
            ->getRepository($this->getEntityName())
            ->createQueryBuilder('c');
        return $querybuilder->select('c')
            ->where('c.type = :type')
            ->setParameter('type',$type)
            ->orderBy('c.id', 'ASC');
    }

    /**
     * Get exist types
     *
     * @return array types
     */
    public function getTypes()
    {
        $querybuilder = $this->_em
            ->getRepository($this->getEntityName())
            ->createQueryBuilder('c');
        $result = $querybuilder->groupBy('c.type')
            ->orderBy('c.type','ASC')
            ->getQuery()->getResult();
        $types = array();
        foreach($result as $res){
            $types[] = $res->getTypeName();
        }
        return $types;

    }

}