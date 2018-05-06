<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 00:14
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\AddCommentArticleNotLoggedDTOInterface;

class AddCommentArticleNotLoggedDTO implements AddCommentArticleNotLoggedDTOInterface
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
     * AddCommentArticleNotLoggedDTO constructor.
     *
     * @param string $email
     * @param string $lastName
     * @param string $content
     */
    public function __construct(
        string $lastName,
        string $email,
        string $content
    ) {
        $this->email = $email;
        $this->content = $content;
        $this->lastName = $lastName;
    }
}
