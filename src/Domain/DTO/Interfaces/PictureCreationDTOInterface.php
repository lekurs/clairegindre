<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:08
 */

namespace App\Domain\DTO\Interfaces;


interface PictureCreationDTOInterface
{
    /**
     * PictureCreationDTOInterface constructor.
     *
     * @param string $picture
     */
    public function __construct(string $picture);
}
