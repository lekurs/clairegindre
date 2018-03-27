<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 15:53
 */

namespace App\Entity\Interfaces;


interface PictureInterface
{

    public function __construct(string $pictureName, string $picturePath, string $extension, int $displayOrder, bool $favorite, GalleryInterface $gallery, ArticleInterface $article);

}