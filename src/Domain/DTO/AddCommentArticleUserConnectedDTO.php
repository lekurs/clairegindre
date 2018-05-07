<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 14:56
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\AddCommentArticleUserConnectedDTOInterface;
use App\Domain\Models\Interfaces\UserInterface;

class AddCommentArticleUserConnectedDTO implements AddCommentArticleUserConnectedDTOInterface
{
    /**
     * @var UserInterface
     */
    public $author;

    /**
     * @var string
     */
    public $content;

    /**
     * AddCommentArticleUserConnectedDTO constructor.
     *
     * @param UserInterface $author
     * @param string $content
     */
    public function __construct(
        UserInterface $author,
        string $content
    ) {
        $this->author = $author;
        $this->content = $content;
    }
}
