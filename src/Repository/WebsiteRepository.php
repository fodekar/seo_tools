<?php

namespace App\Repository;

use App\Entity\Website;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Website|null find($id, $lockMode = null, $lockVersion = null)
 * @method Website|null findOneBy(array $criteria, array $orderBy = null)
 * @method Website[]    findAll()
 * @method Website[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebsiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Website::class);
    }

    public function updateUrl($name, $url)
    {
        return $this->createQueryBuilder('w')
            ->update()
            ->set('w.url', '?1')
            ->setParameter(1, $url)
            ->where('w.name = ?2')
            ->setParameter(2, $name)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
