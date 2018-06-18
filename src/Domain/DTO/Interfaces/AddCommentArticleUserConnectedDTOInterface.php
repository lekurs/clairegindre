<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 14:56
 */

namespace App\Domain\DTO\Interfaces;


use App\Domain\Models\Interfaces\UserInterface;

interface AddCommentArticleUserConnectedDTOInterface
{
    /**
     * AddCommentArticleUserConnectedDTOInterface constructor.
     *
     * @param UserInterface $author
     * @param string $content
     */
    public function __construct(UserInterface $author, string $content);
}
