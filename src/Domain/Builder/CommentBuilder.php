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
     * @param string $email
     * @param string $lastName
     * @param UserInterface $author
     * @param \DateTime $date
     * @return CommentBuilderInterface
     */

//string $email, string $lastName,
//$lastName, $email,
    public function create(string $content, ArticleInterface $article, UserInterface $author, \DateTime $date): CommentBuilderInterface //a refaire
    {
        $this->category = new Comment($content, $article, $author, $date);

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