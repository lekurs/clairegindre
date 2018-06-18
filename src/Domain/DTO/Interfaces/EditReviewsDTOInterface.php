<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 16:14
 */

namespace App\Domain\DTO\Interfaces;


interface EditReviewsDTOInterface
{
    /**
     * EditReviewsDTOInterface constructor.
     *
     * @param string $title
     * @param string $content
     * @param bool $online
     */
    public function __construct(
        string $title,
        string $content,
        bool $online
    );
}
