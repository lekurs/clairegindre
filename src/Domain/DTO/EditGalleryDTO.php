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
use App\Domain\Models\Interfaces\PictureInterface;

class EditGalleryDTO implements GalleryOrderDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var \DateTime
     */
    public $eventDate;

    /**
     * @var string
     */
    public $eventPlace;

    /**
     * @var \ArrayAccess
     */
    public $pictures;

    /**
     * @var string
     */
    public $slug;

    /**
     * EditGalleryDTO constructor.
     * @param string $title
     * @param \DateTime $eventDate
     * @param string $eventPlace
     * @param \ArrayAccess $pictures
     * @param string $slug
     */
    public function __construct(string $title, \DateTime $eventDate, string $eventPlace,  string $slug)
    {
        $this->title = $title;
        $this->eventDate = $eventDate;
        $this->eventPlace = $eventPlace;
//        $this->pictures = $pictures;
        $this->slug = $slug;
    }


}
