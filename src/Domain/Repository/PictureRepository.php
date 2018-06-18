<?php

namespace App\Domain\Repository;

use App\Domain\Models\Article;
use App\Domain\Models\Gallery;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class PictureRepository extends ServiceEntityRepository implements PictureRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Picture::class);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($id)
    {
        return $this->createQueryBuilder('picture')
                            ->where('picture.id = :id')
                            ->setParameter('id', $id)
                            ->getQuery()
                            ->getOneOrNullResult();
    }

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function getAllByGallery(Gallery $gallery)
    {
        return $this->createQueryBuilder('picture')
                            ->innerJoin('picture.gallery', 'gallery')
                            ->where('picture.gallery = :gallery')
                            ->setParameter('gallery', $gallery->getId())
                            ->orderBy('picture.displayOrder', 'ASC')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @return mixed
     */
    public function showPicturesByGallery()
    {
        return $this->createQueryBuilder('picture')
            ->addSelect('gallery')
            ->innerJoin('picture.gallery', 'gallery', 'WHERE', 'picture.gallery = gallery.id')
            ->orderBy('picture.pictureName', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getFavoriteByGalerie(Gallery $galerie)
    {
        return $this->createQueryBuilder('picture')
                                ->leftJoin('picture.gallery', 'gallery')
                                ->where('picture.gallery = :galerie')
                                ->setParameter('galerie', $galerie->getId())
                                ->andWhere('picture.favorite = 1')
                                ->getQuery()
                                ->getOneOrNullResult();
    }

    /**
     * @param $galleryId
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getFavorite($galleryId)
    {
        return $this->createQueryBuilder('picture')
                            ->where('picture.favorite = 1')
                            ->andWhere('picture.gallery = :galleryId')
                            ->setParameter('galleryId', $galleryId)
                            ->getQuery()
                            ->getOneOrNullResult();
    }

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function getWithGalerieMaker(Gallery $gallery)
    {
        return $this->createQueryBuilder('picture')
                            ->leftJoin('picture.gallery', 'gallery')
                            ->where('picture.gallery = :gallery')
                            ->andWhere('picture.galleryMaker IS NOT NULL')
                            ->setParameter('gallery', $gallery->getId())
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param PictureInterface $picture
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PictureInterface $picture)
    {
        $this->getEntityManager()->persist($picture);
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
     * @param PictureInterface $picture
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PictureInterface $picture)
    {
        $this->getEntityManager()->remove($picture);
        $this->getEntityManager()->flush();
    }

    /**
     * @param $oldPicture
     * @param $pictureFavorite
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateFavorite($pictureFavorite, $oldPicture = null)
    {
        if (!is_null($oldPicture)) {
            $oldPicture->setFavorite(0);
        }
        $pictureFavorite->setFavorite(true);
        $this->getEntityManager()->flush();
    }
}
