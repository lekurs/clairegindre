<?php

namespace App\Repository;

use App\Entity\Benefit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;

class BenefitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Benefit::class);
    }

    public function getAll(): array
    {
        $qb = $this->createQueryBuilder()
            ->select('*')
            ->from('benefit')
            ->orderBy('id')
            ->getQuery()
            ;

        return $qb->execute();
    }

    public function getOne($id): array
    {
        $qb = $this->createQueryBuilder()
            ->select('name')
            ->from('benefit')
            ->where('id='.$id)
            ->getQuery()
            ;

        return $qb->execute();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.something = :value')->setParameter('value', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
