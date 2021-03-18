<?php

namespace App\Repository;

use App\Entity\Solidaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Solidaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Solidaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Solidaire[]    findAll()
 * @method Solidaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolidaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solidaire::class);
    }

    // /**
    //  * @return Solidaire[] Returns an array of Solidaire objects
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
    public function findOneBySomeField($value): ?Solidaire
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
