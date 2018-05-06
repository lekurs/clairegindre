<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:35
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\CommentInterface;

interface CommentRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param CommentInterface $comment
     * @return mixed
     */
    public function save(CommentInterface $comment);
}
