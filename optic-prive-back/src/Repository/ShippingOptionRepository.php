<?php

namespace App\Repository;

use App\Entity\ShippingOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShippingOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingOption[]    findAll()
 * @method ShippingOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingOption::class);
    }

    // /**
    //  * @return ShippingOption[] Returns an array of ShippingOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShippingOption
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
