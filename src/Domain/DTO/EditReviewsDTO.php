<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 16:14
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\EditReviewsDTOInterface;

class EditReviewsDTO implements EditReviewsDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var bool
     */
    public $online;

    /**
     * @var string
     */
    public $image;

    /**
     * EditReviewsDTO constructor.
     *
     * @param string $title
     * @param string $content
     * @param bool $online
     * @param string $image
     */
    public function __construct(
        string $title,
        string $content,
        bool $online
//        string $image
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->online = $online;
//        $this->image = $image;
    }


}