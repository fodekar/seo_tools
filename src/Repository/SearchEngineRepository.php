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
}
