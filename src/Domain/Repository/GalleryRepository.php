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
     */
    public function showOne($id)
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

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
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
}
