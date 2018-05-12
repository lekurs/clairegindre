<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:44
 */

namespace App\Domain\Repository;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Models\Gallery;
use App\Domain\Models\Interfaces\GalleryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GalleryRepository extends ServiceEntityRepository implements GalleryRepositoryInterface
{
    /**
     * GalleryRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gallery::class);
    }

    /**
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($slug)
    {
        return $this->createQueryBuilder('gallery')
                                ->where('gallery.slug = :slug')
                                ->setParameter('slug', $slug)
                                ->getQuery()
                                ->getOneOrNullResult();
    }

    public function getAll()
    {
        return $this->createQueryBuilder('gallery')
                            ->orderBy('gallery.creationDate', 'DESC')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getWithPictures($slug)
    {
        return $this->createQueryBuilder('gallery')
            ->where('gallery.slug = :slug')
            ->setParameter('slug', $slug)
            ->innerJoin('gallery.pictures', 'pictures')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getAllWithArticle()
    {
        return $this->createQueryBuilder('gallery')
                            ->where('gallery.articles IS NOT NULL')
                            ->getQuery()
                            ->getResult();
    }

    public function getWithPicturesById($idGallery)
    {
        return $this->createQueryBuilder('gallery')
            ->where('gallery.id = :idGallery')
            ->setParameter('idGallery', $idGallery)
            ->innerJoin('gallery.pictures', 'pictures')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function getGalleryByUser($id)
//    {
//        return $this->createQueryBuilder('gallery')
//                            ->where('gallery.user = :id')
//                            ->setParameter('id', $id)
//                            ->innerJoin('gallery.pictures', 'pictures')
//                            ->getQuery()
//                            ->getResult();
//    }

    /**
     * @param $idUser
     * @param $idGallery
     * @return mixed
     */
    public function getGalleryByUserAndId($idUser, $idGallery)
    {
        return $this->createQueryBuilder('gallery')
                                ->where('gallery.user = :idUser')
                                ->andWhere('gallery.id = :idGallery')
                                ->setParameter('idUser', $idUser)
                                ->setParameter('idGallery', $idGallery)
                                ->innerJoin('gallery.pictures', 'pictures')
                                ->getQuery()
                                ->getResult();
    }

    /**
     * @param int $first
     * @param int $max
     * @return Paginator|mixed
     */
    public function getAllWithPaginator(int $first, int $max)
    {
        $premierePage = ($first -1) * $max;

        $qb = $this->createQueryBuilder('gallery')
                            ->innerJoin('gallery.pictures', 'pictures')
                            ->where('pictures.favorite = 1')
                            ->setFirstResult($premierePage)
                            ->setMaxResults($max);

        return new Paginator($qb);
    }

    /**
     * @return mixed
     */
    public function getGalleryWithoutArticle()
    {
        return $this->createQueryBuilder('gallery')
            ->leftJoin('gallery.article', 'article', 'article_id = null')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param GalleryInterface $gallery
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(GalleryInterface $gallery)
    {
        $this->getEntityManager()->persist($gallery);
        $this->getEntityManager()->flush();
    }

    public function update()
    {
        $this->getEntityManager()->flush();
    }

    public function delete(GalleryInterface $gallery)
    {
        $this->getEntityManager()->remove($gallery);
        $this->getEntityManager()->flush();
    }

    public function removeArticle(ArticleInterface $article, GalleryInterface $gallery)
    {
        $this->getEntityManager()->remove($article);
        $gallery->setArticles(null);
        $this->getEntityManager()->flush();
    }
}
