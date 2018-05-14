<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:29
 */

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryMakerInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use Ramsey\Uuid\Uuid;

class GalleryMaker implements GalleryMakerInterface
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
     * @var \ArrayAccess
     */
    private $articles;

    /**
     * GalleryMaker constructor.
     *
     * @param int $line
     * @param int $displayOrder
     */
    public function __construct(
        int $line,
        int $displayOrder
    ) {
        $this->id = Uuid::uuid4();
        $this->line = $line;
        $this->displayOrder = $displayOrder;
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
     * @return \ArrayAccess
     */
    public function getArticles(): \ArrayAccess
    {
        return $this->articles;
    }

    /**
     * @param ArticleInterface $article
     */
    public function setArticles(ArticleInterface $article): void
    {
        $this->articles[] = $article;

        $article->setGalleryMaker($this);
    }
}
