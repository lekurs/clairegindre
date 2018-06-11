<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:32
 */

namespace App\Domain\Repository\Interfaces;

use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface ArticleRepositoryInterface
{
    /**
     * ArticleRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param $slug
     * @return mixed
     */
    public function getOne($slug);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $id
     * @return mixed
     */
    public function getOneById($id);

    /**
     * @return mixed
     */
    public function getArticlesWithFavoritePictureGallery();

    /**
     * @return mixed
     */
    public function getGalleryWithoutArticle();

    /**
     * @param ArticleInterface $article
     * @param GalleryInterface $gallery
     */
    public function save(ArticleInterface $article, GalleryInterface $gallery): void;

    /**
     * @return mixed
     */
    public function update();

    /**
     * @param ArticleInterface $article
     * @return mixed
     */
    public function updateOnline(ArticleInterface $article);

    /**
     * @param ArticleInterface $article
     */
    public function delete(ArticleInterface $article): void;

}