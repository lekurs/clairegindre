<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:56
 */

namespace App\Builder;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Entity\Gallery;

class GalleryBuilder implements GalleryBuilderInterface
{
    private $gallery;

    public function create(): GalleryBuilderInterface
    {
        $this->gallery = new Gallery();

        return $this;
    }

    public function getGallery(): Gallery
    {
        return $this->gallery;
    }

}