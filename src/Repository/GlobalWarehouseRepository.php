<?php

namespace App\Repository;

use App\Entity\GlobalWarehouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GlobalWarehouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalWarehouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalWarehouse[]    findAll()
 * @method GlobalWarehouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalWarehouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalWarehouse::class);
    }

    // /**
    //  * @return GlobalWarehouse[] Returns an array of Test99 objects
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
