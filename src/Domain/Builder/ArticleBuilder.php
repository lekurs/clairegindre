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
     * @param int $creationDate
     * @param int|null $modificationDate
     * @param bool $online
     * @param UserInterface $author
     * @param string $prestation
     * @return ArticleBuilderInterface
     */
    public function create(string $title, string $content, bool $online, UserInterface $author, string $prestation): ArticleBuilderInterface
    {
        $this->article = new Article($title, $content, $online, $author->getUsername(), $prestation);

        return $this;
    }

    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }
}
