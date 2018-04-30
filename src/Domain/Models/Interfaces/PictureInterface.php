<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 15:53
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\ArticleInterface;

interface PictureInterface
{
    /**
     * PictureInterface constructor.
     *
     * @param string $pictureName
     * @param string $publicPath
     * @param string $extension
     * @param int $displayOrder
     * @param bool $favorite
     * @param \App\Domain\Models\Interfaces\GalleryInterface|null $gallery
     * @param \App\Domain\Models\Interfaces\ArticleInterface|null $article
     */
    public function __construct(string $pictureName, string $publicPath, string $extension, int $displayOrder = 0, bool $favorite = false, GalleryInterface $gallery = null, ArticleInterface $article = null);
}
