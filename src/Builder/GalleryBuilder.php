<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:56
 */

namespace App\Builder;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Entity\Benefit;
use App\Entity\Gallery;
use App\Entity\User;

class GalleryBuilder implements GalleryBuilderInterface
{
    /**
     * @var Gallery
     */
    private $gallery;

    public function create(): GalleryBuilderInterface
    {
        $this->gallery = new Gallery();

        return $this;
    }

    public function withUser(User $user): GalleryBuilderInterface
    {
        $this->gallery->setUser($user);

        return $this;
    }

    public function withBenefit(Benefit $benefit): GalleryBuilderInterface
    {
        $this->gallery->setBenefit($benefit);

        return $this;
    }

    public function getGallery(): Gallery
    {
        return $this->gallery;
    }

}