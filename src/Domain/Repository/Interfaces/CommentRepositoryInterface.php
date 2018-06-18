<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:35
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\CommentInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface CommentRepositoryInterface
{
    /**
     * CommentRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);
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
