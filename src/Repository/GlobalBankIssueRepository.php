<?php

namespace App\Repository;

use App\Entity\GlobalBankIssue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GlobalBankIssue|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalBankIssue|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalBankIssue[]    findAll()
 * @method GlobalBankIssue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalBankIssueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalBankIssue::class);
    }

    // /**
    //  * @return Test99[] Returns an array of Test99 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Test99
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
