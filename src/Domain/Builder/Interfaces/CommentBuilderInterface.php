<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:42
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\UserInterface;

interface CommentBuilderInterface
{
    /**
     * @param UserInterface $author
     * @param string $lastName
     * @param string $email
     * @param string $content
     * @param \DateTime $date
     * @param ArticleInterface $article
     * @return CommentBuilderInterface
     */
//    public function create(string $content, ArticleInterface $article, string $email, string $lastName, UserInterface $author, \DateTime $date): CommentBuilderInterface;

    /**
     * @return Comment
     */
    public function getComment(): Comment;
}
