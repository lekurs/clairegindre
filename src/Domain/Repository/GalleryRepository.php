<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:44
 */

namespace App\Domain\Repository;


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
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function showOne($id)
    {
        return $this->createQueryBuilder()
            ->select('*')
            ->from('gallery')
            ->where('user_id = :userId')
            ->setParameter('user_id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getOne($id)
    {
        return $this->createQueryBuilder('gallery')
                                ->where('gallery.id = :id')
                                ->setParameter('id', $id)
                                ->getQuery()
                                ->getOneOrNullResult();
    }

    /**
     * @param $titleGallery
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getWithPictures($titleGallery)
    {
        return $this->createQueryBuilder('gallery')
            ->where('gallery.title = :titleGallery')
            ->setParameter('titleGallery', $titleGallery)
            ->innerJoin('gallery.pictures', 'pictures')
            ->getQuery()
            ->getOneOrNullResult()
            ;
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

    /**
     * @param $id
     * @return mixed
     */
    public function getGalleryByUser($id)
    {
        return $this->createQueryBuilder('gallery')
                            ->where('gallery.user = :id')
                            ->setParameter('id', $id)
                            ->innerJoin('gallery.pictures', 'pictures')
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
     * @return mixed
     */
    public function getAllWithPictures()
    {
        return $this->createQueryBuilder('gallery')
            ->where('pictures.favorite = 1')
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

    public function update(Gallery $gallery)
    {
        $this->getEntityManager()->flush();
    }

    public function delete(GalleryInterface $gallery)
    {
        $this->getEntityManager()->remove($gallery);
        $this->getEntityManager()->flush();
    }
}
