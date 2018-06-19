<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:15
 */

namespace App\Domain\DTO\Interfaces;


interface RegistrationDTOInterface
{
    /**
     * RegistrationDTOInterface constructor.
     *
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $plainPassword
     * @param \DateTime $dateWedding
     * @param \SplFileInfo $picture
     * @param bool $online
     */
    public function __construct(
        string $email,
        string $username,
        string $lastName,
        string $plainPassword,
        \DateTime $dateWedding,
//        \SplFileInfo $picture,
        bool $online
    );
}
