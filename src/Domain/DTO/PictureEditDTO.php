<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:12
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\PictureEditDTOInterface;

class PictureEditDTO implements PictureEditDTOInterface
{
    /**
     * @var int
     */
    public $displayOrder;

    /**
     * @var bool
     */
    public $favorite;

    /**
     * PictureEditDTO constructor.
     * @param int $displayOrder
     * @param bool $favorite
     */
    public function __construct(
        int $displayOrder,
        bool $favorite
    ) {
        $this->displayOrder = $displayOrder;
        $this->favorite = $favorite;
    }
}
