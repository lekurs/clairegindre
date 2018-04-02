<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:35
 */

namespace App\Domain\Builder\Interfaces;


use App\Entity\Interfaces\ArticleInterface;
use App\Entity\Interfaces\GalleryInterface;

interface ArticleBuilderInterface
{
    public function create(string $title, string $content, GalleryInterface $gallery): ArticleBuilderInterface;

    public function getArticle():ArticleInterface;

}