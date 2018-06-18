<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 15:18
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\ContactTypeDTOInterface;

final class ContactTypeDTO implements ContactTypeDTOInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var string
     */
    public $place;

    /**
     * @var string
     */
    public $howKnow;

    /**
     * @var array
     */
    public $event;

    /**
     * @var string
     */
    public $details;

    /**
     * ContactTypeDTO constructor.
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
    public function __construct(
        string $name,
        string $firstName,
        string $email,
        string $phone,
        \DateTime $date,
        string $place,
        string $howKnow,
        array $event,
        string $details
    ) {
        $this->name = $name;
        $this->firstname = $firstName;
        $this->email = $email;
        $this->phone = $phone;
        $this->date = $date;
        $this->place = $place;
        $this->howKnow = $howKnow;
        $this->event = $event;
        $this->details = $details;
    }
}
