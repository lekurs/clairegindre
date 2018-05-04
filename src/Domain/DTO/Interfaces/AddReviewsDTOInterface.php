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
     * @param bool $online*
     */
    public function __construct(string $title, string $content, bool $online, string $image);
}