<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:56
 */

namespace App\Domain\Builder;


use App\Builder\Interfaces\CategoryBuilderInterface;
use App\Domain\Builder\Interfaces\CommentBuilderInterface;
use App\Entity\Comment;

class CommentBuilder implements CommentBuilderInterface
{
    /**
     * @var Comment
     */
    private $category;

    /**
     * @param string $title
     * @param int $online
     * @return CommentBuilderInterface
     */
    public function create(string $title, $online = 0): CommentBuilderInterface
    {
        $this->category = new Comment($title, $online);

        return $this;
    }

    /**
     * @param Comment $category
     * @return CommentBuilderInterface
     */
    public function withTitle(Comment $category): CommentBuilderInterface
    {
        $this->category->setTitle($category);

        return $this;
    }

    /**
     * @param Comment $category
     * @return CommentBuilderInterface
     */
    public function withOnline(Comment $category): CommentBuilderInterface
    {
        $this->category->setOnline($category);

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