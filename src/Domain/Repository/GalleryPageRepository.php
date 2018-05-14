<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:40
 */

namespace App\Domain\Repository;


use App\Domain\Models\GalleryMaker;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryMakerInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\GalleryPageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GalleryPageRepository extends ServiceEntityRepository implements GalleryPageRepositoryInterface
{
    /**
     * GalleryPageRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
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
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($idArticle)
    {
        return $this->createQueryBuilder('gallery_page')
                            ->where('gallery_page.article = :idArticle')
                            ->setParameter('idArticle', $idArticle)
                            ->getQuery()
                            ->getOneOrNullResult();
    }

    /**
     * @param GalleryMakerInterface $galleryMaker
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(GalleryMakerInterface $galleryMaker, PictureInterface $picture, ArticleInterface $article)
    {
        $picture->setGalleryMaker($galleryMaker);
        $article->setGalleryMaker($galleryMaker);

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
