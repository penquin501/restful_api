<?php

namespace App\Repository;

use App\Entity\MerchantBilling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MerchantBilling|null find($id, $lockMode = null, $lockVersion = null)
 * @method MerchantBilling|null findOneBy(array $criteria, array $orderBy = null)
 * @method MerchantBilling[]    findAll()
 * @method MerchantBilling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantBillingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchantBilling::class);
    }

    public function findBillNo($startDate,$endDate)
    {
        return $this->createQueryBuilder('m')
            ->select('m.parcelBillNo,m.orderdate,CONCAT(mem.firstname,\' \',mem.lastname) as senderName,COUNT(m.parcelBillNo) as numInv')
            ->join('App\Entity\ParcelMember', 'mem', 'WITH', 'm.parcelMemberId = mem.memberId')
            ->Where('m.orderdate >= :startDate')
            ->andWhere('m.orderdate <= :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->groupBy('m.parcelBillNo,m.orderdate,senderName')
            ->getQuery()
            ->getResult()
            ;
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
