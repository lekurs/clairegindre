<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\BenefitInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\Uuid;

class Gallery implements GalleryInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var string
     */
    private $title;

    /**
     * @var BenefitInterface
     */
    private $benefit;

    /**
     * @var \ArrayAccess
     */
    private $pictures;

    /**
     * @var ArticleInterface
     */
    private $article;

    /**
     * Gallery constructor.
     *
     * @param UserInterface $user
     * @param string $title
     * @param BenefitInterface $benefit
     * @param ArticleInterface $article
     */
    public function __construct(
        string $title,
        UserInterface $user,
        BenefitInterface $benefit,
        ArticleInterface $article
    ) {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->user = $user;
        $this->benefit = $benefit;
        $this->article = $article;
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getBenefit()
    {
        return $this->benefit;
    }

    /**
     * @param $benefit
     */
    public function setBenefit(BenefitInterface $benefit): void
    {
        $this->benefit = $benefit;
    }

    /**
     * @return mixed
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param Picture $picture
     */
    public function setPictures(Picture $picture): void
    {
        $this->pictures[] = $picture;

        $picture->setGallery($this);
    }

    /**
     * @return ArticleInterface
     */
    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }

    /**
     * @param ArticleInterface $article
     */
    public function setArticle(ArticleInterface $article): void
    {
        $this->article = $article;
    }
}
