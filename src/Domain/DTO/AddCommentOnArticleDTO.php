<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 00:14
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\AddCommentOnArticleDTOInterface;
use App\Domain\Models\Interfaces\UserInterface;

final class AddCommentOnArticleDTO implements AddCommentOnArticleDTOInterface
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $content;

    /**
     * @var UserInterface
     */
    public $author;

    /**
     * AddCommentOnArticleDTO constructor.
     *
     * @param string $email
     * @param string $lastName
     * @param string $content
     * @param UserInterface $author
     */
    public function __construct(
        string $content,
        string $email = null,
        string $lastName = null,
        UserInterface $author = null
    )    {
        $this->email = $email;
        $this->lastName = $lastName;
        $this->content = $content;
        $this->author = $author;
    }
}
