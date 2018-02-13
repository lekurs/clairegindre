<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegisterRepository")
 */
class Register
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
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
    private $name;

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
    private $lastname;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Length(
     *              min = 8,
     *              max = 20,
     *              minMessage = "Le mot de passe doit contenir au minimum {{ limit }} caractères",
     *              maxMessage = "Le mot de passe ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateWedding;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=300)
     * @Assert\NotBlank(message = "Merci d'ajouter une photo au format JPEG ou PNG")
     * @Assert\Image(
     *          allowLandscape = true,
     *          allowPortrait = true,
     *          mimeTypes = { "image/png", "image/jpg" },
     *          mimeTypeMessage = "Format accepté : JPEG ou PNG uniquement"
 *     )
     */
    private $picture;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return $this
     */
    public function setPicture($file=null)
    {
        $this->picture = $file;

        return $this;
    }
}
