<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 22:18
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\EditBenefitDTOInterface;

final class EditBenefitDTO implements EditBenefitDTOInterface
{
    public $name;

    /**
     * EditBenefitDTO constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
