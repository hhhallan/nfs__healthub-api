<?php

namespace App\Repository;

use App\Entity\Metrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Metrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Metrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Metrix[]    findAll()
 * @method Metrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Metrix::class);
    }

    // /**
    //  * @return Metrix[] Returns an array of Metrix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Metrix
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
