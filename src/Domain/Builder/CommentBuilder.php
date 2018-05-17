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
     * @param string $content
     * @param ArticleInterface $article
     * @param string|null $email
     * @param string|null $lastName
     * @param UserInterface|null $author
     * @return CommentBuilderInterface
     */

    public function create(string $content, ArticleInterface $article, string $email = null, string $lastName = null, UserInterface $author = null): CommentBuilderInterface
    {
        $this->category = new Comment($content, $article, $email, $lastName, $author, new\DateTime());

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