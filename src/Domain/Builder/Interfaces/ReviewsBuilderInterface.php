<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 13:51
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Interfaces\ReviewsInterface;
use App\Domain\Models\Interfaces\UserInterface;

interface ReviewsBuilderInterface
{
    /**
     * @param string $title
     * @param string $content
     * @param \DateTime $creationDate
     * @param UserInterface $user
     * @param string $imagePath
     * @param string $imageName
     * @param bool $online
     * @return ReviewsBuilderInterface
     */
    public function create(string $title, string $content, \DateTime $creationDate, UserInterface $user, string $imagePath, string $imageName, bool $online): ReviewsBuilderInterface;

    public function getReviews(): ReviewsInterface;
}