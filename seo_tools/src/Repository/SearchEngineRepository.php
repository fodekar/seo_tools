<?php

namespace App\Repository;

use App\Entity\SearchEngine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SearchEngine|null find($id, $lockMode = null, $lockVersion = null)
 * @method SearchEngine|null findOneBy(array $criteria, array $orderBy = null)
 * @method SearchEngine[]    findAll()
 * @method SearchEngine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchEngineRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SearchEngine::class);
    }

    // /**
    //  * @return SearchEngine[] Returns an array of SearchEngine objects
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
    public function findOneBySomeField($value): ?SearchEngine
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
