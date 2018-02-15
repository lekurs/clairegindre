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
     * @Assert\NotBlank(message = "Merci d'ajouter une photo au format JPEG ou PNG")
     * @Assert\Image(
     *          allowLandscape = true,
     *          allowPortrait = true,
     *          mimeTypes = { "image/png", "image/jpg" },
     *          mimeTypesMessage = "Format accepté : JPEG ou PNG uniquement"
     *     )
     */
    private $pictureName;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $picturePath;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $extension;

    /**
     * @ORM\Column(type="integer")
     */
    private $benefitFamilyId;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

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
    public function getPictureName()
    {
        return $this->pictureName;
    }

    /**
     * @param mixed $pictureName
     */
    public function setPictureName($pictureName): void
    {
        $this->pictureName = $pictureName;
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
    public function getBenefitFamilyId()
    {
        return $this->benefitFamilyId;
    }

    /**
     * @param mixed $benefitFamilyId
     */
    public function setBenefitFamilyId($benefitFamilyId): void
    {
        $this->benefitFamilyId = $benefitFamilyId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }


}
