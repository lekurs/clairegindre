<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\CategoryInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


class Comment implements CategoryInterface
{

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $category;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $online;

    /**
     * @var \ArrayAccess
     */
    private $benefits;

    /**
     * @var string
     */
    private $picture;

    /**
     * @var UserInterface
     */
    private $author;

    /**
     * @var ArticleInterface
     */
    private $article;

    /**
     * Comment constructor.
     *
     * @param string $title
     * @param string $category
     * @param \DateTime $date
     * @param bool $online
     * @param string $picture
     * @param UserInterface $author
     * @param ArticleInterface $article
     */
    public function __construct(
        string $title,
        string $category,
        \DateTime $date,
        bool $online,
        string $picture,
        UserInterface $author,
        ArticleInterface $article
    ) {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->category = $category;
        $this->date = $date;
        $this->online = $online;
        $this->picture = $picture;
        $this->author = $author;
        $this->article = $article;
    }


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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param mixed $online
     */
    public function setOnline($online): void
    {
        $this->online = $online;
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
     * @return $this
     */
    public function setBenefit(Benefit $benefit)
    {
        $this->benefit = $benefit;

        return $this;
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
     * @return $this
     */
    public function setPicture(Picture $picture)
    {
        $this->picture = $picture;

        return $this;
    }

}