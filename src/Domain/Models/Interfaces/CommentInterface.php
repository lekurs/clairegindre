<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 14:42
 */

namespace App\Domain\Models\Interfaces;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\UserInterface;

interface CommentInterface
{
    /**
     * CommentInterface constructor.
     *
     * @param \App\Domain\Models\Interfaces\UserInterface $author
     * @param string $lastName
     * @param string $email
     * @param string $content
     * @param \DateTime $date
     * @param \App\Domain\Models\Interfaces\ArticleInterface $article
     */
    public function __construct(UserInterface $author, string $lastName, string $email, string $content, \DateTime $date, ArticleInterface $article);
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @return UserInterface
     */
    public function getAuthor(): UserInterface;

    /**
     * @return ArticleInterface
     */
    public function getArticle(): ArticleInterface;
}
