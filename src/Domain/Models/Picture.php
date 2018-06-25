<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\GalleryMakerInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use Ramsey\Uuid\Uuid;
class Picture implements PictureInterface
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
    private $backupPath;

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
     * @var GalleryMakerInterface
     */
    private $galleryMaker;

    /**
     * Picture constructor.
     *
     * @param string $pictureName
     * @param string $publicPath
     * @param string $backupPath
     * @param string $extension
     * @param int $displayOrder
     * @param bool $favorite
     * @param GalleryInterface|null $gallery
     * @param ArticleInterface|null $article
     * @param GalleryMakerInterface|null $galleryPage
     */
    public function __construct(
        string $pictureName,
        string $publicPath,
        string $backupPath,
        string $extension,
        int $displayOrder = 0,
        bool $favorite = false,
        GalleryInterface $gallery = null,
        ArticleInterface $article = null,
        GalleryMakerInterface $galleryPage = null
    ) {
        $this->id = Uuid::uuid4();
        $this->pictureName = $pictureName;
        $this->publicPath = $publicPath;
        $this->backupPath = $backupPath;
        $this->extension = $extension;
        $this->displayOrder = $displayOrder;
        $this->favorite = $favorite;
        $this->gallery = $gallery;
        $this->article = $article;
        $this->galleryMaker = $galleryPage;
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
    public function getPublicPath()
    {
        return $this->publicPath;
    }

    /**
     * @param mixed $publicPath
     */
    public function setPublicPath($publicPath): void
    {
        $this->publicPath = $publicPath;
    }

    /**
     * @return string
     */
    public function getBackupPath(): string
    {
        return $this->backupPath;
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
    public function setGallery(GalleryInterface $gallery): void
    {
        $this->gallery = $gallery;
    }

    /**
     * @return int
     */
    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    /**
     * @param int $displayOrder
     */
    public function setDisplayOrder(int $displayOrder): void
    {
        $this->displayOrder = $displayOrder;
    }

    /**
     * @return bool
     */
    public function getFavorite(): bool
    {
        return $this->favorite;
    }

    /**
     * @param bool $favorite
     */
    public function setFavorite(bool $favorite): void
    {
        $this->favorite = $favorite;
    }

    /**
     * @return GalleryMakerInterface
     */
    public function getGalleryMaker(): GalleryMakerInterface
    {
        return $this->galleryMaker;
    }

    /**
     * @param GalleryMakerInterface $galleryMaker
     */
    public function setGalleryMaker(GalleryMakerInterface $galleryMaker = null): void
    {
        $this->galleryMaker = $galleryMaker;
    }
}
