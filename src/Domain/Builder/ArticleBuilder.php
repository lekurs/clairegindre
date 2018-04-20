<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:35
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\ArticleBuilderInterface;
use App\Domain\Models\Article;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\UserInterface;

class ArticleBuilder implements ArticleBuilderInterface
{
    /**
     * @var ArticleInterface
     */
    private $article;

    /**
     * @param string $title
     * @param string $content
     * @param \DateTime $creationDate
     * @param bool $online
     * @param UserInterface $author
     * @param GalleryInterface $gallery
     * @param string $prestation
     * @return ArticleBuilderInterface
     */
    public function create(string $title, string $content, \DateTime $creationDate, bool $online, UserInterface $author, GalleryInterface $gallery, string $prestation): ArticleBuilderInterface
    {
        $this->article = new Article($title, $content, $creationDate = new \DateTime(), $online, $author->getUsername(), $gallery->getGallery(), $prestation);

        return $this;
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }
}
