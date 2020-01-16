<?php

namespace App\Repository;

use App\Entity\CheckParcelDrop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CheckParcelDrop|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckParcelDrop|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckParcelDrop[]    findAll()
 * @method CheckParcelDrop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckParcelDropRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckParcelDrop::class);
    }

    public function findRemainTracking($status,$userId,$merId)
    {
        return $this->createQueryBuilder('cDrop')
            ->select('cDrop.parcelRef as tracking')
            ->Where('cDrop.status = :status')
            ->andWhere('cDrop.merId = :merId')
            ->andWhere('cDrop.agentUserId = :agentUserId')
//            ->andWhere('cDrop.dateDrop = :dateDrop')
            ->setParameter('status', $status)
            ->setParameter('merId', $merId)
            ->setParameter('agentUserId', $userId)
//            ->setParameter('dateDrop', $dateDrop)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return CheckParcelDrop[] Returns an array of Test99 objects
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
