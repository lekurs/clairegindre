<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 14:12
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\EditUserDTOInterface;

class EditUserDTO implements EditUserDTOInterface
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
     * @var bool
     */
    public $online;

    /**
     * @var \DateTime
     */
    public $weddingDate;

    /**
     * @var \SplFileInfo
     */
    public $picture;

    /**
     * EditUserDTO constructor.
     *
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $plainPassword
     * @param bool $online
     * @param \DateTime $dateWedding
     * @param \SplFileInfo $picture
     */
    public function __construct(
        string $email,
        string $username,
        string $lastName,
        string $plainPassword,
        bool $online,
        \DateTime $dateWedding
//        \SplFileInfo $picture = null
    )
    {
        $this->email = $email;
        $this->username = $username;
        $this->lastName = $lastName;
        $this->plainPassword = $plainPassword;
        $this->online = $online;
        $this->weddingDate = $dateWedding;
//        $this->picture = $picture;
    }
}
