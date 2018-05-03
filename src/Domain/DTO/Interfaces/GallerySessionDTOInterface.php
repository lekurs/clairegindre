<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 21:26
 */

namespace App\Domain\DTO\Interfaces;


interface GallerySessionDTOInterface
{
    /**
     * GallerySessionDTOInterface constructor.
     *
     * @param string $id
     * @param string $title
     */
    public function __construct(string $id);
}
