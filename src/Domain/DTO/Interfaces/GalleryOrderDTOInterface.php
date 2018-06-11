<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:30
 */

namespace App\Domain\DTO\Interfaces;


interface GalleryOrderDTOInterface
{
    /**
     * GalleryOrderDTOInterface constructor.
     *
     * @param string $title
     * @param \DateTime $eventDate
     * @param string $eventPlace
     * @param array $pictures
     * @param string $slug
     */
    public function __construct(
        string $title,
        \DateTime $eventDate,
        string $eventPlace,
        array $pictures,
        string $slug
    );
}
