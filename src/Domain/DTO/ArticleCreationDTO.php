<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:14
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\ArticleCreationDTOInterface;
use App\Domain\Models\Interfaces\GalleryInterface;

class ArticleCreationDTO implements ArticleCreationDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var GalleryInterface
     */
    public $gallery;

    /**
     * ArticleCreationDTO constructor.
     *
     * @param string $title
     * @param string $content
     * @param GalleryInterface $gallery
     */
    public function __construct(
        string $title,
        string $content,
        GalleryInterface $gallery
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->gallery = $gallery;
    }
}
