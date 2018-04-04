<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:15
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\RegistrationDTOInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;


class RegistrationDTO implements RegistrationDTOInterface
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $plainPassword;

    /**
     * @var int
     */
    public $dateWedding;

    /**
     * @var PictureInterface
     */
    public $picture; //A vérifier

    /**
     * @var UserInterface
     */
    public $user; //A vérifier

    /**
     * RegistrationDTO constructor.
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $plainPassword
     * @param int $dateWedding
     * @param PictureInterface $picture
     * @param UserInterface $user
     */
    public function __construct(
        string $email,
        string $username,
        string $lastName,
        string $plainPassword,
        int $dateWedding,
        PictureInterface $picture,
        UserInterface $user
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->lastName = $lastName;
        $this->plainPassword = $plainPassword;
        $this->dateWedding = $dateWedding;
        $this->picture = $picture;
        $this->user = $user;
    }
}
