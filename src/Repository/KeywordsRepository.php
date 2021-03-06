<?php

namespace App\Repository;

use App\Entity\Keywords;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Keywords|null find($id, $lockMode = null, $lockVersion = null)
 * @method Keywords|null findOneBy(array $criteria, array $orderBy = null)
 * @method Keywords[]    findAll()
 * @method Keywords[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeywordsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Keywords::class);
    }
}
