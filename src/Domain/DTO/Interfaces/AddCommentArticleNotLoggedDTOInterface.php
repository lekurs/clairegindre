<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 00:14
 */

namespace App\Domain\DTO\Interfaces;


interface AddCommentArticleNotLoggedDTOInterface
{
    /**
     * AddCommentArticleNotLoggedDTOInterface constructor.
     *
     * @param string $email
     * @param string $lastName
     * @param string $content
     */
    public function __construct(string $email, string $lastName, string $content);
}
