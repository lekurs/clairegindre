<?php

namespace App\Domain\Repository;

use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function getAll()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function save(CommentInterface $comment)
    {
        $this->getEntityManager()->persist($comment);
        $this->getEntityManager()->flush();
    }
}
