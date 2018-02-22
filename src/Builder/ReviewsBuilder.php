<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/02/2018
 * Time: 14:52
 */

namespace App\Builder;


use App\Builder\Interfaces\ReviewsBuilderInterface;
use App\Entity\Picture;
use App\Entity\Reviews;

class ReviewsBuilder implements ReviewsBuilderInterface
{
    /**
     * @var Reviews
     */
    private $reviews;

    public function create(): ReviewsBuilderInterface
    {
        $this->reviews = new Reviews();

        return $this;
    }

    public function withPicture(Picture $picture): ReviewsBuilderInterface
    {
        $this->reviews->setImage($picture);

        return $this;
    }

    public function getReviews(): Reviews
    {
        return $this->reviews;
    }
}