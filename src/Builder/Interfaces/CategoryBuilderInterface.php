<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:42
 */

namespace App\Builder\Interfaces;


use App\Entity\Comment;

interface CategoryBuilderInterface
{
    public function create(): CategoryBuilderInterface;

    public function withTitle(Comment $category): CategoryBuilderInterface;

    public function withOnline(Comment $category): CategoryBuilderInterface;

    public function getCategory(): Comment;
}