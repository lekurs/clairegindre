<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:56
 */

namespace App\Builder;


use App\Builder\Interfaces\CategoryBuilderInterface;
use App\Entity\Comment;

class CategoryBuilder implements CategoryBuilderInterface
{
    /**
     * @var Comment
     */
    private $category;

    public function create(): CategoryBuilderInterface
    {
        $this->category = new Comment();

        return $this;
    }

    public function withTitle(Comment $category): CategoryBuilderInterface
    {
        $this->category->setTitle($category);

        return $this;
    }

    public function withOnline(Comment $category): CategoryBuilderInterface
    {
        $this->category->setOnline($category);

        return $this;
    }

    public function getCategory(): Comment
    {
        return $this->category;
    }
}