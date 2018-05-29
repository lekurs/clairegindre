<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:56
 */

namespace App\Domain\Builder;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Models\Benefit;
use App\Domain\Models\Gallery;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\BenefitInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;

class GalleryBuilder implements GalleryBuilderInterface
{
    /**
     * @var Gallery
     */
    private $gallery;

    public function create(string $title, UserInterface $user, \DateTime $eventDate, string $eventPlace, BenefitInterface $benefit, string $slug, \Datetime $creationDate, ArticleInterface $article = null): GalleryBuilderInterface
    {
        $this->gallery = new Gallery($title, $user, $eventDate, $eventPlace, $benefit, $slug, $creationDate = new \DateTime(), $article);

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

    public function withPicture(PictureInterface $picture): GalleryBuilderInterface
    {
        $this->gallery->setPictures($picture);

        return $this;
    }

    public function withArticle(ArticleInterface $article): GalleryBuilderInterface
    {
        $this->gallery->setArticle($article);

        return $this;
    }

    public function getGallery(): GalleryInterface
    {
        return $this->gallery;
    }

}