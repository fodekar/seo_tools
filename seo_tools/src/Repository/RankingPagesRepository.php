<?php

namespace App\Repository;

use App\Entity\RankingPages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RankingPages|null find($id, $lockMode = null, $lockVersion = null)
 * @method RankingPages|null findOneBy(array $criteria, array $orderBy = null)
 * @method RankingPages[]    findAll()
 * @method RankingPages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RankingPagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RankingPages::class);
    }

    // /**
    //  * @return RankingPages[] Returns an array of RankingPages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RankingPages
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
