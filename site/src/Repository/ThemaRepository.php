<?php

namespace App\Repository;

use App\Entity\Thema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Thema|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thema|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thema[]    findAll()
 * @method Thema[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thema::class);
    }

    // /**
    //  * @return Thema[] Returns an array of Thema objects
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
    public function findOneBySomeField($value): ?Thema
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
