<?php

namespace App\Domain\Repository;

use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{
    /**
     * CommentRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->createQueryBuilder('comment')
            ->orderBy('comment.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param CommentInterface $comment
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(CommentInterface $comment)
    {
        $this->getEntityManager()->persist($comment);
        $this->getEntityManager()->flush();
    }
}
