<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 13:51
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\ReviewsBuilderInterface;
use App\Domain\Models\Interfaces\ReviewsInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\Reviews;

class ReviewsBuilder implements ReviewsBuilderInterface
{
    /**
     * @var ReviewsInterface
     */
    private $reviews;

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
    public function create(string $title, string $content, \DateTime $creationDate, UserInterface $user, string $imagePath, string $imageName, bool $online): ReviewsBuilderInterface
    {
        $this->reviews = new Reviews($title, $content, $creationDate, $user, $imagePath, $imageName, $online);

        return $this;
    }

    /**
     * @return ReviewsInterface
     */
    public function getReviews(): ReviewsInterface
    {
        return $this->reviews;
    }
}