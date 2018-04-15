<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 11:54
 */

namespace App\Domain\Builder;

use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Picture;
use App\Domain\Models\Gallery;

class PictureBuilder implements PictureBuilderInterface
{
    /**
     * @var Picture
     */
    private $picture;

    public function create(string $pictureName, string $publicPath, string $extension, int $displayOrder, bool $favorite = false, GalleryInterface $gallery = null, ArticleInterface $article = null): PictureBuilderInterface
    {
        $this->picture = new Picture($pictureName, $publicPath, $extension, $displayOrder, $favorite, $gallery, $article);

        return $this;
    }

    public function withName(string $name): PictureBuilderInterface
    {
        $this->picture->setPicture($name);

        return $this;
    }

    public function withExtension(string $extension): PictureBuilderInterface
    {
        $this->picture->setExtension($extension);

        return $this;
    }

    public function withPath(string $path): PictureBuilderInterface
    {
        $this->picture->setPicturePath($path);

        return $this;
    }

    public function withBenefit(string $benefit): PictureBuilderInterface
    {
        $this->picture->setBenefit($benefit);

        return $this;
    }

    public function withGallery(Gallery $gallery): PictureBuilderInterface
    {
        $this->picture->setGallery($gallery);

        return $this;
    }

    public function withUserName(string $userName): PictureBuilderInterface
    {
        $this->picture->setUserName($userName);

        return $this;
    }

    public function getPicture(): Picture
    {
        return $this->picture;
    }

}