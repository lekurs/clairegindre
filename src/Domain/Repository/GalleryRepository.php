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

final class GalleryRepository extends ServiceEntityRepository implements GalleryRepositoryInterface
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
     * @param $slugGallery
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($slugGallery)
    {
        return $this->createQueryBuilder('gallery')
                                ->where('gallery.slug = :slugGallery')
                                ->setParameter('slugGallery', $slugGallery)
                                ->getQuery()
                                ->getOneOrNullResult();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->createQueryBuilder('gallery')
                            ->orderBy('gallery.creationDate', 'DESC')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @return mixed
     */
    public function getLastNine()
    {
        return $this->createQueryBuilder('gallery')
                            ->leftJoin('gallery.pictures', 'pictures')
                            ->where('pictures.favorite = 1')
                            ->orderBy('gallery.eventDate', 'DESC')
                            ->setMaxResults(9)
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
            ->orderBy('pictures.displayOrder', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @return mixed
     */
    public function getAllWithArticle()
    {
        return $this->createQueryBuilder('gallery')
                            ->where('gallery.article IS NOT NULL')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param $idGallery
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
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

    /**
     * @param $slugUser
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getGalleryByUser($slugUser)
    {
        return $this->createQueryBuilder('gallery')
                            ->where('gallery.user = :slugUser')
                            ->setParameter('slugUser', $slugUser)
                            ->getQuery()
                            ->getOneOrNullResult();
    }

    /**
     * @param $idUser
     * @return mixed
     */
    public function getAllByUser($idUser)
    {
        return $this->createQueryBuilder('gallery')
                            ->where('gallery.user = :idUser')
                            ->setParameter('idUser', $idUser)
                            ->getQuery()
                            ->getResult();
    }

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
     * @param $idArticle
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findArticle($idArticle)
    {
        return $this->createQueryBuilder('gallery')
                            ->where('gallery.article = :idArticle')
                            ->setParameter('idArticle', $idArticle)
                            ->getQuery()
                            ->getOneOrNullResult();
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

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param GalleryInterface $gallery
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(GalleryInterface $gallery)
    {
        $this->getEntityManager()->remove($gallery);
        $this->getEntityManager()->flush();
    }

    /**
     * @param ArticleInterface $article
     * @param GalleryInterface $gallery
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeArticle(ArticleInterface $article, GalleryInterface $gallery)
    {
        $gallery->setArticle(null);
        $this->getEntityManager()->remove($article);
        $this->getEntityManager()->flush();
    }
}
