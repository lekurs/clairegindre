<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:29
 */

namespace App\Domain\DTO;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\DTO\Interfaces\GalleryOrderDTOInterface;

class GalleryOrderDTO implements GalleryOrderDTOInterface
{
    /**
     * @var array
     */
    public $pictures;

    /**
     * @var GalleryBuilderInterface
     */
    public $galleryBuilder;

    /**
     * GalleryOrderDTO constructor.
     *
     * @param array $pictures
     * @param GalleryBuilderInterface $galleryBuilder
     */
    public function __construct(
        array $pictures,
        GalleryBuilderInterface $galleryBuilder
    ) {
        $this->pictures = $pictures;
        $this->galleryBuilder = $galleryBuilder;
    }
}
