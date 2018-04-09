<?php

namespace App\Domain\Repository;

use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\RegisterRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RegisterRepository extends ServiceEntityRepository implements RegisterRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
}
