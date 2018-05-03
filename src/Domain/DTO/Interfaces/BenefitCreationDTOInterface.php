<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 21:07
 */

namespace App\Domain\DTO\Interfaces;


interface BenefitCreationDTOInterface
{
    /**
     * BenefitCreationDTOInterface constructor.
     *
     * @param string $name
     */
    public function __construct(string $name);
}
