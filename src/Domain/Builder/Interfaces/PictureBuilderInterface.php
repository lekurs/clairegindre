<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 11:37
 */

namespace App\Domain\Builder\Interfaces;



use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Picture;

interface PictureBuilderInterface
{
    /**
     * @param string $pictureName
     * @param string $publicPath
     * @param string $extension
     * @param int $displayOrder
     * @param bool $favorite
     * @param GalleryInterface|null $gallery
     * @param ArticleInterface|null $article
     * @return PictureBuilderInterface
     */
    public function create(string $pictureName, string $publicPath, string $extension, int $displayOrder, bool $favorite = false, GalleryInterface $gallery = null, ArticleInterface $article = null): PictureBuilderInterface;

    /**
     * @param string $name
     * @return PictureBuilderInterface
     */
    public function withName(string $name): PictureBuilderInterface;

    /**
     * @param string $path
     * @return PictureBuilderInterface
     */
    public function withPath(string $path): PictureBuilderInterface;

    /**
     * @param string $extension
     * @return PictureBuilderInterface
     */
    public function withExtension(string $extension): PictureBuilderInterface;

    /**
     * @param string $userName
     * @return PictureBuilderInterface
     */
    public function withUserName(string $userName): PictureBuilderInterface;

    /**
     * @param string $benefit
     * @return PictureBuilderInterface
     */
    public function withBenefit(string $benefit): PictureBuilderInterface;

    /**
     * @param int $order
     * @return PictureBuilderInterface
     */
    public function withOrder(int $order): PictureBuilderInterface;

    /**
     * @return Picture
     */
    public function getPicture():Picture;
}