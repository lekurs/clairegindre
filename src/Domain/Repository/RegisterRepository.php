<?php

namespace App\Domain\Repository;

use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\RegisterRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class RegisterRepository extends ServiceEntityRepository implements RegisterRepositoryInterface
{
    /**
     * RegisterRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}
