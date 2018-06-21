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

final class ReviewsRepository extends ServiceEntityRepository implements ReviewsRepositoryInterface
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

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
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
     */
    public function save(ReviewsInterface $reviews):void
    {
        $this->_em->persist($reviews);
        $this->_em->flush();
    }


    public function update(): void
    {
        $this->_em->flush();
    }

    /**
     * @param Reviews $reviews
     */
    public function updateOnline(Reviews $reviews):void
    {
        if ($reviews->isOnline() == true) {
            $reviews->manageOnline(false);
        } else {
            $reviews->manageOnline(true);
        }

        $this->_em->flush();
    }

    /**
     * @param ReviewsInterface $reviews
     * @return mixed|void
     */
    public function delete(ReviewsInterface $reviews):void
    {
        $this->_em->remove($reviews);
        $this->_em->flush();
    }
}
