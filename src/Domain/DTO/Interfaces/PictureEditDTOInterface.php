<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:13
 */

namespace App\Domain\DTO\Interfaces;


interface PictureEditDTOInterface
{
    /**
     * PictureEditDTOInterface constructor.
     *
     * @param int $displayOrder
     * @param bool $favorite
     */
    public function __construct(int $displayOrder, bool $favorite);
}
