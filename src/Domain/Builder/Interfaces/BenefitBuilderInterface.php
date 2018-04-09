<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 16:06
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Benefit;

interface BenefitBuilderInterface
{
    /**
     * @param string $name
     * @return BenefitBuilderInterface
     */
    public function create(string $name): BenefitBuilderInterface;

    /**
     * @param Benefit $name
     * @return BenefitBuilderInterface
     */
    public function withName(Benefit $name): BenefitBuilderInterface;

    /**
     * @return Benefit
     */
    public function getBenefit(): Benefit;

}