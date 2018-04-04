<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 13:05
 */

namespace App\Domain\Builder;


use App\Builder\Interfaces\BenefitBuilderInterface;
use App\Entity\Benefit;

class BenefitBuilder implements BenefitBuilderInterface
{
    /**
     * @var Benefit
     */
    private $benefit;

    public function create(string $name): BenefitBuilderInterface
    {
        $this->benefit = new Benefit($name);

        return $this;
    }

    public function withName(Benefit $name): BenefitBuilderInterface
    {
        $this->benefit->setName($name);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBenefit(): Benefit
    {
        return $this->benefit;
    }

}