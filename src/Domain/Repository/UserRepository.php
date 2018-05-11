<?php

namespace App\Domain\Repository;

use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository extends ServiceEntityRepository implements UserLoaderInterface, UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $username
     * @return mixed|null|\Symfony\Component\Security\Core\User\UserInterface
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function showAll(): array
    {
        $qb = $this->createQueryBuilder('u')
                ->select('u.username', 'u.email', 'u.id', 'u.lastName')
                ->orderBy('u.id', 'DESC')
                ->getQuery()
            ;

        return $qb->execute();
    }

    /**
     * @param $slug
     * @return User
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($slug): User
    {
        return $this->createQueryBuilder('user')
            ->where('user.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $first
     * @param $max
     * @return Paginator|mixed
     */
    public function showGalleryByUserWithPagination(int $first, int $max)
    {
        $premierePage = ($first - 1) * $max;

        $qb = $this->createQueryBuilder('user')
            ->leftJoin('user.galleries', 'galleries')
            ->setFirstResult($premierePage)
            ->setMaxResults($max);

        return new Paginator($qb);
    }

    public function showGalleryByUser()
    {
        return $this->createQueryBuilder('user')
                            ->leftJoin('user.galleries', 'galleries')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param UserInterface $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(UserInterface $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function update()
    {
        $this->getEntityManager()->flush();
    }
}
