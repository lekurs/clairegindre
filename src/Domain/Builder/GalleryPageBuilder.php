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

    public function create(int $displayOrder, string $images): GalleryPageInterface
    {
        $this->galleryPageBuilder =  new GalleryPage($displayOrder, $images);

        return $this;
    }

    public function getGalleryBuilder(): GalleryPageInterface
    {
        return $this->galleryPageBuilder;
    }
}