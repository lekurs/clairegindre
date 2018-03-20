<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:56
 */

namespace App\Builder;


use App\Builder\Interfaces\CategoryBuilderInterface;
use App\Entity\Category;

class CategoryBuilder implements CategoryBuilderInterface
{
    /**
     * @var Category
     */
    private $category;

    public function create(): CategoryBuilderInterface
    {
        $this->category = new Category();

        return $this;
    }

    public function withTitle(Category $category): CategoryBuilderInterface
    {
        $this->category->setTitle($category);

        return $this;
    }

    public function withOnline(Category $category): CategoryBuilderInterface
    {
        $this->category->setOnline($category);

        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}