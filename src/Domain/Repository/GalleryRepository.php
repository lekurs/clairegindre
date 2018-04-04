<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:44
 */

namespace App\Domain\Repository;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Entity\Gallery;
use App\Entity\Interfaces\GalleryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GalleryRepository extends ServiceEntityRepository implements GalleryRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gallery::class);
    }

    public function save(GalleryInterface $gallery)
    {
        $this->getEntityManager()->persist($gallery);
        $this->getEntityManager()->flush();
    }
}