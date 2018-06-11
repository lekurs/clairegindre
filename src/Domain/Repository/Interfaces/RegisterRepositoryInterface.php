<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:39
 */

namespace App\Domain\Repository\Interfaces;


use Symfony\Bridge\Doctrine\RegistryInterface;

interface RegisterRepositoryInterface
{
    /**
     * RegisterRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);
}
