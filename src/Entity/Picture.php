<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length = 300)
     * @ORM\ManyToOne(targetEntity="App\Entity\Gallery", cascade={"persist"})
     * @Assert\NotBlank(message = "Merci d'ajouter une photo au format JPEG ou PNG")
     * @Assert\Image(
     *          allowLandscape = true,
     *          allowPortrait = true,
     *          mimeTypes = { "image/png", "image/jpg", "image/jpeg" },
     *          mimeTypesMessage = "Format accepté : JPEG / JPG ou PNG uniquement"
     *     )
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $picturePath;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $extension;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $benefit;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $userName;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reviews", inversedBy="image")
     */
    private $review;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="picture")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Gallery", inversedBy="gallery")
     */
    private $gallery;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param mixed $review
     */
    public function setReview($review): void
    {
        $this->review = $review;
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
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $pictureName
     */
    public function setPicture($pictureName): void
    {
        $this->picture = $pictureName;
    }

    /**
     * @return mixed
     */
    public function getPicturePath()
    {
        return $this->picturePath;
    }

    /**
     * @param mixed $picturePath
     */
    public function setPicturePath($picturePath): void
    {
        $this->picturePath = $picturePath;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension): void
    {
        $this->extension = $extension;
    }

    /**
     * @return mixed
     */
    public function getBenefit()
    {
        return $this->benefit;
    }

    /**
     * @param mixed $benefitFamily
     */
    public function setBenefit($benefitFamily): void
    {
        $this->benefit = $benefitFamily;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param mixed $gallery
     */
    public function setGallery($gallery): void
    {
        $this->gallery = $gallery;
    }

    public function __toString()
    {
        return $this->picture;
    }

    public function addTag(Gallery $gallery)
    {
        $gallery->setGallery($this);
    }

    public function removeTag(Picture $picture)
    {
        $this->picture->remove($picture);
    }
}
