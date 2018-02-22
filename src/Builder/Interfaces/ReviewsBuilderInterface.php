<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/02/2018
 * Time: 14:51
 */

namespace App\Builder\Interfaces;


use App\Entity\Picture;
use App\Entity\Reviews;

interface ReviewsBuilderInterface
{

    public function create(): ReviewsBuilderInterface;

    public function withPicture(Picture $picture): ReviewsBuilderInterface;

    public function getReviews(): Reviews;

}