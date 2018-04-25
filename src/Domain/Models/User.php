<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface as BaseUser;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, BaseUser
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var \DateTime
     */
    private $dateWedding;

    /**
     * @var PictureInterface
     */
    private $picture;

    /**
     * @var bool
     */
    private $online;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var \ArrayAccess
     */
    private $galleries;

    /**
     * @var \ArrayAccess
     */
    private $benefits;

    /**
     * @var \ArrayAccess
     */
    private $articles;

    /**
     * @var \ArrayAccess
     */
    private $comments;

    /**
     * @var \ArrayAccess
     */
    private $reviews;

    /**
     * User constructor.
     *
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $plainPassword
     * @param callable $encoder
     * @param \DateTime $dateWedding
     * @param PictureInterface $picture
     * @param bool $online
     * @param string $roles
     */
    public function __construct(
        string $email,
        string $username,
        string $lastName,
        string $plainPassword,
        callable $encoder,
        \DateTime $dateWedding,
        PictureInterface $picture,
        bool $online,
        string $roles
    ) {
        $this->id = Uuid::uuid4();
        $this->email = $email;
        $this->username = $username;
        $this->lastName = $lastName;
        $this->password = $encoder($plainPassword, null);
        $this->dateWedding = $dateWedding;
        $this->picture = $picture;
        $this->online = $online;
        $this->roles[] = $roles;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $name
     */
    public function setUsername($name): void
    {
        $this->username = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDateWedding()
    {
        return $this->dateWedding;
    }

    /**
     * @param mixed $dateWedding
     */
    public function setDateWedding($dateWedding): void
    {
        $this->dateWedding = $dateWedding;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    /**
     * @param Picture $picture
     */
    public function setPicture(Picture $picture)
    {
        $this->picture = $picture;

        $picture->setUser($this);
    }

    /**
     * @return \ArrayAccess
     */
    public function getGalleries(): \ArrayAccess
    {
        return $this->galleries;
    }

    /**
     * @return \ArrayAccess
     */
    public function getBenefits(): \ArrayAccess
    {
        return $this->benefits;
    }

    /**
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles[] = $roles;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
