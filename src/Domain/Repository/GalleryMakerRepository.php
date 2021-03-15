<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:40
 */

namespace App\Domain\Repository;


use App\Domain\Models\Gallery;
use App\Domain\Models\GalleryMaker;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryMakerInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\GalleryMakerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class GalleryMakerRepository extends ServiceEntityRepository implements GalleryMakerRepositoryInterface
{
    /**
     * GalleryMakerRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GalleryMaker::class);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->createQueryBuilder('gallery_page')
                            ->orderBy('gallery_page.line', 'ASC')
                            ->addOrderBy('gallery_page.displayOrder', 'ASC')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param $idArticle
     * @return mixed
     */
    public function getByArticle($idArticle)
    {
        return $this->createQueryBuilder('gallery_page')
                            ->where('gallery_page.article = :idArticle')
                            ->setParameter('idArticle', $idArticle)
                            ->orderBy('gallery_page.line', 'ASC')
                            ->addOrderBy('gallery_page.displayOrder', 'ASC')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param GalleryMakerInterface $galleryMaker
     * @param PictureInterface $picture
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(GalleryMakerInterface $galleryMaker, PictureInterface $picture)
    {
        $picture->setGalleryMaker($galleryMaker);

        $this->getEntityManager()->persist($galleryMaker);
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
}
