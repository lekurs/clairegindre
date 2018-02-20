<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/02/2018
 * Time: 14:52
 */

namespace App\Builder;


use App\Builder\Interfaces\ReviewsBuilderInterface;
use App\Entity\Reviews;

class ReviewsBuilder implements ReviewsBuilderInterface
{
    /**
     * @var Reviews
     */
    private $reviews;

    public function create(string $reviews): ReviewsBuilderInterface
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getReviews(): Reviews
    {
        return $this->reviews;
    }
}