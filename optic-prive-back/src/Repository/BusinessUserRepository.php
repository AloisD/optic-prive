<?php

namespace App\Repository;

use App\Entity\BusinessUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessUser[]    findAll()
 * @method BusinessUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessUser::class);
    }

    // /**
    //  * @return BusinessUser[] Returns an array of BusinessUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BusinessUser
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
