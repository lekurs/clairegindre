<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 21:13
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\BenefitInterface;
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
     * @return array
     */
    public function getAll(): array ;

    /**
     * @param $id
     * @return array
     */
    public function getOne($id): array;

    /**
     * @param BenefitInterface $benefit
     */
    public function save(BenefitInterface $benefit): void;

    /**
     * @param BenefitInterface $benefit
     */
    public function edit(BenefitInterface $benefit): void;
}
