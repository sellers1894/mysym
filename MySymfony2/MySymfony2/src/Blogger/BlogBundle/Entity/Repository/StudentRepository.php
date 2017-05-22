<?php

namespace Blogger\BlogBundle\Entity\Repository;

/**
 * StudentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StudentRepository extends \Doctrine\ORM\EntityRepository{
    public function getStudentForCompany($companyId){
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.company = :company_id')
//            ->addOrderBy('c.created')
            ->setParameter('company_id', $companyId);

        return $qb->getQuery()
            ->getResult();
    }

    public function getStudent(){
        $qb = $this->createQueryBuilder('s')
            ->select('s');
//            ->addOrderBy('c.id', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function getStudentOnId($id){
        $qb = $this->createQueryBuilder('s')
            ->select('s')
            ->where('s.id = :s_id')
            ->setParameter('s_id', $id);
        return $qb->getQuery()->getResult();
    }

    public function deleteStudent($id){
        $qb = $this->createQueryBuilder('BloggerBlogBundle:Student', 's')
            ->delete('BloggerBlogBundle:Student', 's')
            ->where('s.id = :s_id')
            ->setParameter('s_id', $id);

        return $qb->getQuery()->getResult();
    }
}
