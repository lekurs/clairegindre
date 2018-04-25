<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:09
 */

namespace App\Domain\DTO\Interfaces;

interface AddReviewsDTOInterface
{
    /**
     * AddReviewsDTOInterface constructor.
     *
     * @param string $title
     * @param string $content
     * @param string $image
     */
    public function __construct(string $title, string $content, string $image);
}