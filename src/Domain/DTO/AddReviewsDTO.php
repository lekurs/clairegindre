<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:09
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\AddReviewsDTOInterface;

class AddReviewsDTO implements AddReviewsDTOInterface
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
     * AddReviewsDTO constructor.
     *
     * @param string $title
     * @param string $content
     * @param string $image
     */
    public function __construct(
        string $title,
        string $content,
        string $image
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
    }
}
