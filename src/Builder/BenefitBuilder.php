<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 13:05
 */

namespace App\Builder;


use App\Builder\Interfaces\BenefitBuilderInterface;
use App\Entity\Benefit;

class BenefitBuilder implements BenefitBuilderInterface
{
    /**
     * @var Benefit
     */
    private $benefit;

    public function create(): BenefitBuilderInterface
    {
        $this->benefit = new Benefit();

        return $this;
    }

    public function withName(string $name): BenefitBuilderInterface
    {
        $this->benefit->setBenefit($name);

        return $this;
    }

    public function withId(int $id): BenefitBuilderInterface
    {
        $this->benefit->setId($id);

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