<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 10:58
 */

namespace App\Domain\Repository;


use App\Domain\Models\Interfaces\ReviewsInterface;
use App\Domain\Models\Reviews;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ReviewsRepository extends ServiceEntityRepository implements ReviewsRepositoryInterface
{
    /**
     * ReviewsRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reviews::class);
    }

    public function getOne($id)
{
    return $this->createQueryBuilder('reviews')
        ->where('reviews.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getOneOrNullResult();
}

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->createQueryBuilder('reviews')
            ->orderBy('reviews.creationDate', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed
     */
    public function getAllOnline()
    {
        return $this->createQueryBuilder('reviews')
                            ->where('reviews.online = true')
                            ->orderBy('reviews.creationDate', 'DESC')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param ReviewsInterface $reviews
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(ReviewsInterface $reviews)
    {
        $this->getEntityManager()->persist($reviews);
        $this->getEntityManager()->flush();
    }

    /**
     * @param ReviewsInterface $reviews
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(ReviewsInterface $reviews)
    {
        $this->getEntityManager()->remove($reviews);
        $this->getEntityManager()->flush();
    }
}
