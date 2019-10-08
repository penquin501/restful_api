<?php

namespace App\Repository;

use App\Entity\MerchantConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MerchantConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method MerchantConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method MerchantConfig[]    findAll()
 * @method MerchantConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchantConfig::class);
    }

    // /**
    //  * @return MerchantConfig[] Returns an array of Test99 objects
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
