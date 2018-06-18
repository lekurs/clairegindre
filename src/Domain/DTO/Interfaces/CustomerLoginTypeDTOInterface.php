<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 30/04/2018
 * Time: 23:28
 */

namespace App\Domain\DTO\Interfaces;


interface CustomerLoginTypeDTOInterface
{
    /**
     * CustomerLoginTypeDTOInterface constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password);
}
