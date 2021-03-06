<?php

namespace Blogger\BlogBundle\Entity\Repository;

/**
 * RoleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoleRepository extends \Doctrine\ORM\EntityRepository{
    public function getRole($id = null){
        $qb = $this->createQueryBuilder('r')
            ->select('r');

        if (false === is_null($id))
            $qb->andWhere('r.id = :r_id')
                ->setParameter('r_id', $id);

        return $qb->getQuery()->getResult();
    }
}
