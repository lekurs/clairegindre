<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 00:14
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\AddCommentArticleUserNotConnectedDTOInterface;
use App\Domain\Models\Interfaces\ArticleInterface;

class AddCommentArticleUserUserNotConnectedDTO implements AddCommentArticleUserNotConnectedDTOInterface
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
     * @var string
     */
    public $article;

    /**
     * AddCommentArticleUserUserNotConnectedDTO constructor.
     *
     * @param string $email
     * @param string $lastName
     * @param string $content
     * @param ArticleInterface $article
     */
    public function __construct(
        string $email,
        string $lastName,
        string $content
//        ArticleInterface $article
    ) {
        $this->email = $email;
        $this->lastName = $lastName;
        $this->content = $content;
//        $this->article = $article;
    }
}
