<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:29
 */

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryPageInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use Ramsey\Uuid\Uuid;

class GalleryPage implements GalleryPageInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var ArticleInterface
     */
    private $article;

    /**
     * @var string
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
     * GalleryPage constructor.
     *
     * @param ArticleInterface $article
     * @param string $line
     * @param int $displayOrder
     */
    public function __construct(
        ArticleInterface $article,
        string $line,
        int $displayOrder
    ) {
        $this->id = Uuid::uuid4();
        $this->article = $article;
        $this->line = $line;
        $this->displayOrder = $displayOrder;
    }

    /**
     * @return ArticleInterface
     */
    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }

    /**
     * @return string
     */
    public function getLine(): string
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
}
