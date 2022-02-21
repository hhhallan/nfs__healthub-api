<?php

namespace App\Repository;

use App\Entity\UserMetrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserMetrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMetrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMetrix[]    findAll()
 * @method UserMetrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMetrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMetrix::class);
    }

    // /**
    //  * @return UserMetrix[] Returns an array of UserMetrix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserMetrix
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
