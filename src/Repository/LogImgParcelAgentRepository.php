<?php

namespace App\Repository;

use App\Entity\LogImgParcelAgent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LogImgParcelAgent|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogImgParcelAgent|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogImgParcelAgent[]    findAll()
 * @method LogImgParcelAgent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogImgParcelAgentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogImgParcelAgent::class);
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
