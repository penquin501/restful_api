<?php

namespace App\Repository;

use App\Entity\GlobalAuthen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GlobalAuthen|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalAuthen|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalAuthen[]    findAll()
 * @method GlobalAuthen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalAuthenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalAuthen::class);
    }

    public function findParcelMember($phoneno)
    {
        return $this->createQueryBuilder('g')
            ->select('g.id as agentUserId,g.fname as agentFName,g.phoneno as agentPhone,g.merid as agentMerId,m.merchantname as agentMerchantName,m.merLevel as agentLv')
            ->Join('App\Entity\MerchantConfig', 'm', 'WITH', 'g.merid = m.takeorderby')
            ->Where('m.merType = \'parcel\'')
            ->andWhere('g.phoneno = :phoneno')
            ->setParameter('phoneno', $phoneno)
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
