<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:29
 */

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\ArticleInterface;
use Ramsey\Uuid\Uuid;

class GalleryMaker
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $line;

    /**
     * @var \ArrayAccess
     */
    private $images;

    /**
     * @var int
     */
    private $displayOrder;

    /**
     * @var ArticleInterface
     */
    private $article;

    /**
     * GalleryMaker constructor.
     *
     * @param int $line
     * @param int $displayOrder
     * @param ArticleInterface $article
     */
    public function __construct(
        ArticleInterface $article,
        int $line,
        int $displayOrder
    ) {
        $this->id = Uuid::uuid4();
        $this->line = $line;
        $this->displayOrder = $displayOrder;
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * @return \ArrayAccess
     */
    public function getImages(): \ArrayAccess
    {
        return $this->images;
    }

    /**
     * @return int
     */
    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    /**
     * @return ArticleInterface
     */
    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }

    /**
     * @param ArticleInterface $article
     */
    public function setArticle(ArticleInterface $article): void
    {
        $this->article = $article;
    }
}
