<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:54
 */

namespace App\Builder\Interfaces;


use App\Entity\Gallery;

interface GalleryBuilderInterface
{
    public function create(): GalleryBuilderInterface;

    public function getGallery(): Gallery;

}