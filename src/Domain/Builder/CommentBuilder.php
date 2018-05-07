<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:56
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\CommentBuilderInterface;
use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\UserInterface;

class CommentBuilder implements CommentBuilderInterface
{
    /**
     * @var Comment
     */
    private $category;

    /**
     * @param UserInterface $author
     * @param string $lastName
     * @param string $email
     * @param string $content
     * @param \DateTime $date
     * @param ArticleInterface $article
     * @return CommentBuilderInterface
     */
    public function create(UserInterface $author, string $lastName, string $email, string $content, \DateTime $date, ArticleInterface $article): CommentBuilderInterface
    {
        $this->category = new Comment($author = null, $lastName, $email, $content, $date, $article);

        return $this;
    }

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->category;
    }
}