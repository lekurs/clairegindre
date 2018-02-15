<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 13:04
 */

namespace App\Builder\Interfaces;


use App\Entity\Benefit;

interface BenefitBuilderInterface
{
    public function create(): BenefitBuilderInterface;

    public function withName(string $name): BenefitBuilderInterface;

    public function getBenefit(): Benefit;
}