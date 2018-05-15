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
     * @param string $content
     * @param ArticleInterface $article
     * @param string|null $email
     * @param string|null $lastName
     * @param UserInterface|null $author
     */
    public function __construct(
        string $content,
        ArticleInterface $article,
//        string $email = null,
//        string $lastName = null,
        UserInterface $author = null
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->article = $article;
//        $this->email = $email;
//        $this->lastName = $lastName;
        $this->author = $author;
        $this->date = new \DateTime();
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
