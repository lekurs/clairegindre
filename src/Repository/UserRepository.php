<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function showAll(): array
    {
        $qb = $this->createQueryBuilder('u')
                ->select('u.username', 'u.email', 'u.id', 'u.lastName')
                ->orderBy('u.id', 'DESC')
                ->getQuery()
            ;

        return $qb->execute();
    }

    public function showOne($id): User
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function showGalleryByUser()
    {
        return $this->createQueryBuilder('user')
            ->innerJoin('user.galleries', 'galleries')
            ->getQuery()
            ->getResult();
    }
}
