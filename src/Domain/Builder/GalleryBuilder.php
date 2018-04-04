<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:56
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Entity\Benefit;
use App\Entity\Gallery;
use App\Entity\Interfaces\BenefitInterface;
use App\Entity\Interfaces\GalleryInterface;
use App\Entity\Interfaces\UserInterface;
use App\Entity\User;

class GalleryBuilder implements GalleryBuilderInterface
{
    /**
     * @var Gallery
     */
    private $gallery;

    public function create(string $title, UserInterface $user, BenefitInterface $benefit)
    {
        $this->gallery = new Gallery($title, $user->getUser(), $benefit->getBenefit());

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

    public function getGallery(): GalleryInterface
    {
        return $this->gallery;
    }

}