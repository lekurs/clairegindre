<?php

namespace App\Domain\Repository;

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


    public function showPicturesByGallery()
    {
        $qb = $this->createQueryBuilder('picture')
            ->addSelect('gallery')
            ->innerJoin('picture.gallery', 'gallery', 'WHERE', 'picture.gallery = gallery.id')
            ->orderBy('picture.pictureName', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
