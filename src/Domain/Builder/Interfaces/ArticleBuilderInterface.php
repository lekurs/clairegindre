<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:35
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\UserInterface;

interface ArticleBuilderInterface
{
    public function create(string $title, string $content, bool $online, UserInterface $author, string $prestation): ArticleBuilderInterface;

    public function getArticle():ArticleInterface;

}