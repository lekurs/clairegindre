<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 21:26
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\GallerySessionDTOInterface;

class GallerySessionDTO implements GallerySessionDTOInterface
{
    /**
     * @var string
     */
    public $id;

    /**
     * GallerySessionDTO constructor.
     *
     * @param string $id
     */
    public function __construct(
        string $id
    ) {
        $this->id = $id;
    }
}
