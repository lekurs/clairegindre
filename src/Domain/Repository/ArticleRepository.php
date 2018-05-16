<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:53
 */

namespace App\Domain\Repository;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Models\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    /**
     * ArticleRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($slug)
    {
         return $this->createQueryBuilder('article')
                            ->where('article.slug = :slug')
                            ->setParameter('slug', $slug)
                            ->getQuery()
                            ->getOneOrNullResult();
    }

    public function getAll()
    {
        return $this->createQueryBuilder('article')
                                ->orderBy('article.creationDate', 'DESC')
                                ->getQuery()
                                ->getResult();
    }

    public function getArticlesWithFavoritePictureGallery()
    {
        return $this->createQueryBuilder('article')
                ->leftJoin('article.gallery', 'gallery')
                ->leftJoin('gallery.pictures', 'pictures')
                ->getQuery()
                ->getResult();
    }

    public function getGalleryWithoutArticle()
    {
        return $this->createQueryBuilder('article')
                            ->leftJoin('article.gallery', 'gallery', 'gallery.id = null')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param ArticleInterface $article
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(ArticleInterface $article, GalleryInterface $gallery): void
    {
        $gallery->setArticle($article);
//        dump($gallery);
//        die();
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param ArticleInterface $article
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(ArticleInterface $article): void
    {
        $this->getEntityManager()->remove($article);
        $this->getEntityManager()->flush();
    }
}
