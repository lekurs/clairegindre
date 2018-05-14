<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:33
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\GalleryMakerBuilderInterface;
use App\Domain\Models\GalleryMaker;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryMakerInterface;

class GalleryMakerBuilder implements GalleryMakerBuilderInterface
{
    /**
     * @var GalleryMakerInterface
     */
    private $galleryMaker;

    /**
     * @param ArticleInterface $article
     * @param int $line
     * @param int $displayOrder
     * @return GalleryMakerInterface
     */
    public function create(int $line, int $displayOrder): GalleryMakerBuilderInterface
    {
        $this->galleryMaker =  new GalleryMaker($line, $displayOrder);

        return $this;
    }

    /**
     * @return GalleryMakerInterface
     */
    public function getGalleryBuilder(): GalleryMakerInterface
    {
        return $this->galleryMaker;
    }
}