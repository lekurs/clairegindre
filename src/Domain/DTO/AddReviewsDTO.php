<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:09
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\AddReviewsDTOInterface;

final class AddReviewsDTO implements AddReviewsDTOInterface
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
     * @var string
     */
    public $image;

    /**
     * @var bool
     */
    public $online;

    /**
     * AddReviewsDTO constructor.
     *
     * @param string $title
     * @param string $content
     * @param string $image
     * @param bool $online
     */
    public function __construct(
        string $title,
        string $content,
        bool $online,
        string $image
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->online = $online;
        $this->image = $image;
    }
}
