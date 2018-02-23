<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

//EquatableInterface
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Regex(
     *              pattern="/\d/",
     *              match = false,
     *              message = "Le nom ne peut pas contenir un numéro"
     *  )
     * @Assert\Length(
     *              min = 2,
     *              max = 50,
     *              minMessage = "Le nom doit contenir au moins {{ limit }} caractères",
     *              maxMessage = "Le nom ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(
     *              min = 2,
     *              max = 50,
     *              minMessage = "Le prénom doit être de {{ limit }} caractères minimum",
     *              maxMessage = "Le prénom ne doit pas dépasser {{ limit }} caractères",
     *     )
     * @Assert\Regex(
     *              pattern="/\d/",
     *              match = false,
     *              message = "Le nom ne peut pas contenir de chiffre"
     *  )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Assert\Length(
     *              min = 8,
     *              max = 64,
     *              minMessage = "Le mot de passe doit contenir au minimum {{ limit }} caractères",
     *              maxMessage = "Le mot de passe ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $password;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateWedding;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $benefit;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Picture", mappedBy="user", cascade={"persist", "remove"})
     */
    private $picture;

//    /**
//     * @ORM\Column(type="array")
//     */
//    private $roles;

//    /**
//     * @ORM\Column(name="is_active", type="boolean")
//     */
//    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
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
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param $password
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
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
    public function getBenefit()
    {
        return $this->benefit;
    }

    /**
     * @param mixed $benefit
     */
    public function setBenefit($benefit): void
    {
        $this->benefit = $benefit;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
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
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
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
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
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
