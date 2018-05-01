<?php

namespace App\Domain\Repository;

use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PictureRepository extends ServiceEntityRepository implements PictureRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Picture::class);
    }

    /**
     * @return mixed
     */
    public function showPicturesByGallery()
    {
        $qb = $this->createQueryBuilder('picture')
            ->addSelect('gallery')
            ->innerJoin('picture.gallery', 'gallery', 'WHERE', 'picture.gallery = gallery.id')
            ->orderBy('picture.pictureName', 'ASC')
            ->getQuery();

        return $qb->execute();
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
}
