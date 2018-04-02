<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 21:13
 */

namespace App\Domain\Repository\Interfaces;


use App\Entity\Interfaces\BenefitInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface BenefitRepositoryInterface
{
    /**
     * BenefitRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param BenefitInterface $benefit
     */
    public function save(BenefitInterface $benefit): void;

}