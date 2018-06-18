<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 14:12
 */

namespace App\Domain\DTO\Interfaces;


interface EditUserDTOInterface
{
    /**
     * EditUserDTOInterface constructor.
     * 
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $plainPassword
     * @param bool $online
     * @param \DateTime $dateWedding
     * @param string $slug
     */
    public function __construct(string $email, string $username, string $lastName, string $plainPassword, bool $online, \DateTime $dateWedding, string $slug);

}