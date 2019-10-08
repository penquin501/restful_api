<?php

namespace App\Repository;

use App\Entity\MerchantProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MerchantProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method MerchantProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method MerchantProduct[]    findAll()
 * @method MerchantProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchantProduct::class);
    }

    public function findParcelSizePrice($takeorderby,$productId,$productName)
    {
        return $this->createQueryBuilder('m')
            ->select('m.productname,m.productprice,g.productid as pId,g.productcost,m.productid as mId')
            ->Join('App\Entity\GlobalProduct', 'g', 'WITH', 'm.productGlobalId = g.productid')
            ->Where('g.productClass = :productClass')
            ->andWhere('m.takeorderby = :takeorderby')
            ->andWhere('g.productid IN (:productId)')
            ->andWhere('g.productname LIKE :productname')
            ->setParameter('productClass', 'parcel')
            ->setParameter('productId', $productId)
            ->setParameter('takeorderby', $takeorderby)
            ->setParameter('productname', '%'.$productName)
            ->orderBy('m.productprice','ASC')
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
