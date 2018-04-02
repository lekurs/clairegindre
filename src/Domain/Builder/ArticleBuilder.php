<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:35
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\ArticleBuilderInterface;
use App\Entity\Article;
use App\Entity\Interfaces\ArticleInterface;
use App\Entity\Interfaces\GalleryInterface;

class ArticleBuilder implements ArticleBuilderInterface
{
    /**
     * @var ArticleInterface
     */
    private $article;

    public function create(string $title, string $content, GalleryInterface $gallery): ArticleBuilderInterface
    {
        $this->article = new Article($title, $content, $gallery, $gallery->getBenefit());

        return $this;
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }

}