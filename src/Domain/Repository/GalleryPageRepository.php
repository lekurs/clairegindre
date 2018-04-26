<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:40
 */

namespace App\Domain\Repository;


use App\Domain\Models\GalleryPage;
use App\Domain\Repository\Interfaces\GalleryPageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GalleryPageRepository extends ServiceEntityRepository implements GalleryPageRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GalleryPage::class);
    }

}