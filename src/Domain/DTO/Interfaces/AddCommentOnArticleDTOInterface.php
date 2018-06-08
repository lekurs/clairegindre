<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 00:14
 */

namespace App\Domain\DTO\Interfaces;



use App\Domain\Models\Interfaces\UserInterface;

interface AddCommentOnArticleDTOInterface
{
    /**
     * AddCommentOnArticleDTOInterface constructor.
     *
     * @param string $content
     * @param string|null $email
     * @param string|null $lastName
     * @param UserInterface|null $author
     */
    public function __construct(
        string $content,
        string $email = null,
        string $lastName = null,
        UserInterface $author = null
    );
}
