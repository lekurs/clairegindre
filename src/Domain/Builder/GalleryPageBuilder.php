<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:33
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\GalleryPageBuilderInterface;
use App\Domain\Models\GalleryPage;
use App\Domain\Models\Interfaces\GalleryPageInterface;

class GalleryPageBuilder implements GalleryPageBuilderInterface
{
    /**
     * @var GalleryPageInterface
     */
    private $galleryPageBuilder;

    /**
     * @param ArticleInterface $article
     * @param int $line
     * @param int $displayOrder
     * @return GalleryPageInterface
     */
    public function create(ArticleInterface $article, int $line, int $displayOrder): GalleryPageInterface
    {
        $this->galleryPageBuilder =  new GalleryPage($article, $line, $displayOrder);

        return $this;
    }

    /**
     * @return GalleryPageInterface
     */
    public function getGalleryBuilder(): GalleryPageInterface
    {
        return $this->galleryPageBuilder;
    }
}