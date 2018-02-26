<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:54
 */

namespace App\Builder\Interfaces;


use App\Entity\Benefit;
use App\Entity\Gallery;
use App\Entity\User;

interface GalleryBuilderInterface
{
    public function create(): GalleryBuilderInterface;

    public function withUser(User $user): GalleryBuilderInterface;

    public function withBenefit(Benefit $benefit): GalleryBuilderInterface;

    public function getGallery(): Gallery;
}