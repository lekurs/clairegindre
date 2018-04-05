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
use Symfony\Component\HttpFoundation\File\UploadedFile;


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
     * @var \DateTime
     */
    public $dateWedding;

    /**
     * @var string
     */
    public $picture; //A vérifier

    /**
     * @var string
     */
    public $role;

    /**
     * RegistrationDTO constructor.
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $plainPassword
     * @param \DateTime $dateWedding
     * @param string $picture
     */
    public function __construct(
        string $email,
        string $username,
        string $lastName,
        string $plainPassword,
        \DateTime $dateWedding,
        string $picture,
        string $role
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->lastName = $lastName;
        $this->plainPassword = $plainPassword;
        $this->dateWedding = $dateWedding;
        $this->picture = $picture;
        $this->role = $role;
    }

    /**
     * @return \DateTime
     */
    public function getDateWedding(): \DateTime
    {
        return $this->dateWedding;
    }

    /**
     * @param \DateTime $dateWedding
     */
    public function setDateWedding(\DateTime $dateWedding): void
    {
        $this->dateWedding = $dateWedding;
    }


}
