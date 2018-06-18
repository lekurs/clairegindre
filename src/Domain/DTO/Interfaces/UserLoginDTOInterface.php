<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 10:38
 */

namespace App\Domain\DTO\Interfaces;


interface UserLoginDTOInterface
{
    /**
     * UserLoginDTOInterface constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password);
}
