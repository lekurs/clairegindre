<?php

namespace App\Entity;

use App\Entity\Interfaces\ArticleInterface;
use App\Entity\Interfaces\GalleryInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class Picture
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $pictureName;

    /**
     * @var string
     */
    private $publicPath;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var int
     */
    private $displayOrder;

    /**
     * @var boolean
     */
    private $favorite;

    /**
     * @var GalleryInterface
     */
    private $gallery;

    /**
     * @var ArticleInterface
     */
    private $article;

    /**
     * Picture constructor.
     * @param string $pictureName
     * @param string $publicPath
     * @param string $extension
     * @param int $displayOrder
     * @param bool $favorite
     * @param GalleryInterface $gallery
     * @param ArticleInterface $article
     */
    public function __construct(
        string $pictureName,
        string $publicPath,
        string $extension,
        int $displayOrder = 0,
        bool $favorite = false,
        GalleryInterface $gallery = null,
        ArticleInterface $article = null
    ) {
        $this->id = Uuid::uuid4();
        $this->pictureName = $pictureName;
        $this->publicPath = $publicPath;
        $this->extension = $extension;
        $this->displayOrder = $displayOrder;
        $this->favorite = $favorite;
        $this->gallery = $gallery;
        $this->article = $article;
    }


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
     * @param Benefit $benefit
     */
    public function setBenefit(Benefit $benefit)
    {
        $this->benefit = $benefit;

        $benefit->setName($this);
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
}
