<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 21:06
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\BenefitCreationDTOInterface;
use App\Domain\Models\Interfaces\BenefitInterface;

class BenefitCreationDTO implements BenefitCreationDTOInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * BenefitCreationDTO constructor.
     *
     * @param string $name
     * @param BenefitInterface $benefit
     */
    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }
}
