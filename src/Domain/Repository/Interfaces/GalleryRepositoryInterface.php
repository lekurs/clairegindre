<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:43
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\GalleryInterface;

interface GalleryRepositoryInterface
{
    public function save(GalleryInterface $gallery);
}