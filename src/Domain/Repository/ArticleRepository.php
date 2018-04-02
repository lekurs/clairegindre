<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:53
 */

namespace App\Domain\Repository;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Entity\Article;
use App\Entity\Interfaces\ArticleInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(ArticleInterface $article): void
    {
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
    }
}
