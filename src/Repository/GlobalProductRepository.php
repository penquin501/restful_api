<?php

namespace App\Repository;

use App\Entity\GlobalProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GlobalProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalProduct[]    findAll()
 * @method GlobalProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalProduct::class);
    }

    // /**
    //  * @return GlobalProduct[] Returns an array of Test99 objects
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
