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
    private $articles;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * Gallery constructor.
     *
     * @param string $title
     * @param UserInterface $user
     * @param BenefitInterface $benefit
     * @param string $slug
     * @param \DateTime $creationDate
     * @param ArticleInterface|null $articles
     */
    public function __construct(
        string $title,
        UserInterface $user,
        BenefitInterface $benefit,
        string $slug,
        \DateTime $creationDate,
        ArticleInterface $articles = null
    ) {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->user = $user;
        $this->benefit = $benefit;
        $this->slug = $slug;
        $this->creationDate = new \DateTime();
        $this->articles = $articles;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getBenefit()
    {
        return $this->benefit;
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
    public function getArticles(): ArticleInterface
    {
        return $this->articles;
    }

    /**
     * @param ArticleInterface $articles
     */
    public function setArticles(ArticleInterface $articles = null): void
    {
        $this->articles = $articles;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
