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
use Symfony\Component\Finder\SplFileInfo;
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
     * @var bool
     */
    public $online;

    /**
     * @var \SplFileInfo
     */
    public $picture; //A vérifier


    /**
     * RegistrationDTO constructor.
     *
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $plainPassword
     * @param \DateTime $dateWedding
     * @param $online
     * @param string $picture
     */
    public function __construct(
        string $email,
        string $username,
        string $lastName,
        string $plainPassword,
        \DateTime $dateWedding,
        \SplFileInfo $picture,
        bool $online
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->lastName = $lastName;
        $this->plainPassword = $plainPassword;
        $this->dateWedding = $dateWedding;
        $this->picture = $picture;
        $this->online = $online;
    }
}
