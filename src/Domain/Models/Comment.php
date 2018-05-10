<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\Uuid;


class Comment implements CommentInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var UserInterface
     */
    private $author;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var ArticleInterface
     */
    private $article;

    /**
     * Comment constructor.
     *
     * @param UserInterface $author
     * @param string $lastName
     * @param string $email
     * @param string $content
     * @param \DateTime $date
     * @param ArticleInterface $article
     */
    public function __construct(
        UserInterface $author = null,
        string $lastName = null,
        string $email = null,
        string $content,
        ArticleInterface $article
    ) {
        $this->id = Uuid::uuid4();
        $this->author = $author;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->content = $content;
        $this->date = new \DateTime();
        $this->article = $article;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return UserInterface
     */
    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    /**
     * @return ArticleInterface
     */
    public function getArticle(): ArticleInterface
    {
        return $this->article;
    }
}
