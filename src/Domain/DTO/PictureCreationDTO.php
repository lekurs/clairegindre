<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:08
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\PictureCreationDTOInterface;

final class PictureCreationDTO implements PictureCreationDTOInterface
{
    /**
     * @var string
     */
    public $picture;

    /**
     * PictureCreationDTO constructor.
     *
     * @param string $picture
     */
    public function __construct(string $picture)
    {
        $this->picture = $picture;
    }
}
