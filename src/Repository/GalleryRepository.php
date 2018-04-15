<?php

namespace App\Repository;

use App\Entity\Gallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GalleryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gallery::class);
    }

    public function find($id)
    {
        $qb = $this->createQueryBuilder()
            ->select('*')
            ->from('gallery')
            ->where('user_id = :userId')
            ->setParameter('user_id', $id)
            ->getQuery()
            ;

        return $qb->execute();
    }

    public function getWithPictures($id)
    {
        return $this->createQueryBuilder('gallery')
            ->where('gallery.id = :id')
            ->setParameter('id', $id)
            ->innerJoin('gallery.pictures', 'pictures')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function showAll()
    {
        return $this->createQueryBuilder('gallery')
            ->orderBy('id', 'ASC')
            ->getQuery()
            ;
    }
}
