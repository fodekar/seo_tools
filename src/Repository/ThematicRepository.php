<?php

namespace App\Repository;

use App\Entity\Thematic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Thematic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thematic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thematic[]    findAll()
 * @method Thematic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThematicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Thematic::class);
    }
}
