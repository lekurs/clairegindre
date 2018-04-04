<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:42
 */

namespace App\Domain\Builder\Interfaces;


use App\Entity\Comment;

interface CommentBuilderInterface
{
    public function create(string $title, $online = 0): CommentBuilderInterface;

    public function withTitle(Comment $category): CommentBuilderInterface;

    public function withOnline(Comment $category): CommentBuilderInterface;

    public function getComment(): Comment;
}