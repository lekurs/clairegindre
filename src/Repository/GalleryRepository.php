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

    public function showGalleryByUser()
    {
        $qb = $this->createQueryBuilder('gallery')
            ->addSelect('user')
            ->innerJoin('gallery.user', 'user', 'WHERE', 'gallery.user = user.id')
            ->orderBy('gallery.user', 'ASC')
            ->getQuery();

        return $qb->execute();
        }
}
