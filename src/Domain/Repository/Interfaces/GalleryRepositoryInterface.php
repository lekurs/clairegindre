<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:43
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface GalleryRepositoryInterface
{
    /**
     * GalleryRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param $slugGallery
     * @return mixed
     */
    public function getOne($slugGallery);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getLastNine();

    /**
     * @param $slug
     * @return mixed
     */
    public function getWithPictures($slug);

    /**
     * @return mixed
     */
    public function getAllWithArticle();

    /**
     * @param $idGallery
     * @return mixed
     */
    public function getWithPicturesById($idGallery);

    /**
     * @param $slugUser
     * @return mixed
     */
    public function getGalleryByUser($slugUser);

    /**
     * @param $idUser
     * @return mixed
     */
    public function getAllByUser($idUser);

    /**
     * @param $idUser
     * @param $idGallery
     * @return mixed
     */
    public function getGalleryByUserAndId($idUser, $idGallery);


    /**
     * @param int $first
     * @param int $max
     * @return mixed
     */
    public function getAllWithPaginator(int $first, int $max);

    /**
     * @return mixed
     */
    public function getGalleryWithoutArticle();

    /**
     * @param $idArticle
     * @return mixed
     */
    public function findArticle($idArticle);

    /**
     * @param GalleryInterface $gallery
     * @return mixed
     */
    public function save(GalleryInterface $gallery);

    /**
     * @return mixed
     */
    public function update();

    /**
     * @param GalleryInterface $gallery
     * @return mixed
     */
    public function delete(GalleryInterface $gallery);

    /**
     * @param ArticleInterface $article
     * @param GalleryInterface $gallery
     * @return mixed
     */
    public function removeArticle(ArticleInterface $article, GalleryInterface $gallery);
}
