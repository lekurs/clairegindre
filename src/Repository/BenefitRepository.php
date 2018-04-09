<?php

namespace App\Repository;

use App\Domain\Models\Benefit;
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
        $qb = $this->createQueryBuilder('b')
            ->select('b.name')
//            ->from('benefit')
            ->orderBy('id')
            ->getQuery()
            ;

        return $qb->execute();
    }

    public function getOne($id): array
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b.name')
//            ->from('benefit')
            ->where('id='.$id)
            ->getQuery()
            ;

        return $qb->execute();
    }
}
