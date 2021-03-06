<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:44
 */

namespace App\Domain\Repository;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryMakerInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Models\Gallery;
use App\Domain\Models\Interfaces\GalleryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

final class GalleryRepository extends ServiceEntityRepository implements GalleryRepositoryInterface
{
    /**
     * GalleryRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
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
     * @param $idGallery
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById($idGallery)
    {
        return $this->createQueryBuilder('gallery')
                                ->where('gallery.id = :gallery')
                                ->setParameter('gallery', $idGallery)
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
                            ->leftJoin('gallery.article', 'article')
                            ->where('pictures.favorite = 1')
                            ->andWhere('gallery.online = true')
                            ->andWhere('gallery.article IS NOT NULL')
                            ->andWhere('article.online = 1')
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
                            ->leftJoin('gallery.article', 'article')
                            ->where('article.online = 1')
                            ->orderBy('gallery.eventDate', 'DESC')
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
            ->orderBy('gallery.eventDate', 'DESC')
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
                            ->orderBy('gallery.eventDate', 'DESC')
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
     * @param Gallery $gallery
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Gallery $gallery)
    {
        $this->_em->persist($gallery);
        $this->_em->flush();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update()
    {
        $this->_em->flush();
    }

    /**
     * @param Gallery $gallery
     */
    public function updateOnline(Gallery $gallery)
    {
        if ($gallery->isOnline() == true) {
            $gallery->manageOnline(false);
        } else {
            $gallery->manageOnline(true);
        }
        $this->_em->flush();
    }

    /**
     * @param GalleryInterface $gallery
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(GalleryInterface $gallery)
    {
        $this->_em->remove($gallery);
        $this->_em->flush();
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

        foreach ($gallery->getPictures() as $picture) {
            $picture->setGalleryMaker(null);
        }
        
        $this->_em->remove($article);
        $this->_em->flush();
    }
}
