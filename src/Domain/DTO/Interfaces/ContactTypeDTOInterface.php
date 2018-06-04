<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 15:20
 */

namespace App\Domain\DTO\Interfaces;


interface ContactTypeDTOInterface
{
    /**
     * ContactTypeDTOInterface constructor.
     *
     * @param string $name
     * @param string $firstName
     * @param string $email
     * @param string $phone
     * @param \DateTime $date
     * @param string $place
     * @param string $howKnow
     * @param array $event
     * @param string $details
     */
    public function __construct(string $name, string $firstName, string $email, string $phone, \DateTime $date, string $place, string $howKnow, array $event, string $details);

}