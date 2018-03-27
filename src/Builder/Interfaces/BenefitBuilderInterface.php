<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 16:06
 */

namespace App\Builder\Interfaces;


use App\Entity\Benefit;

interface BenefitBuilderInterface
{
    public function create(): BenefitBuilderInterface;

    public function withName(Benefit $name): BenefitBuilderInterface;

    public function getBenefit(): Benefit;

}