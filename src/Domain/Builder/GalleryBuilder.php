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

final class GalleryBuilder implements GalleryBuilderInterface
{
    /**
     * @var Gallery
     */
    private $gallery;

    /**
     * @param string $title
     * @param UserInterface $user
     * @param \DateTime $eventDate
     * @param string $eventPlace
     * @param BenefitInterface $benefit
     * @param string $slug
     * @param \Datetime $creationDate
     * @param ArticleInterface|null $article
     * @param bool $online
     * @return GalleryBuilderInterface
     */
    public function create(string $title, UserInterface $user, \DateTime $eventDate, string $eventPlace, BenefitInterface $benefit, string $slug, \Datetime $creationDate, ArticleInterface $article = null, bool $online = true): GalleryBuilderInterface
    {
        $this->gallery = new Gallery($title, $user, $eventDate, $eventPlace, $benefit, $slug, $creationDate = new \DateTime(), $article, $online);

        return $this;
    }

    /**
     * @param User $user
     * @return GalleryBuilderInterface
     */
    public function withUser(User $user): GalleryBuilderInterface
    {
        $this->gallery->setUser($user);

        return $this;
    }

    /**
     * @param Benefit $benefit
     * @return GalleryBuilderInterface
     */
    public function withBenefit(Benefit $benefit): GalleryBuilderInterface
    {
        $this->gallery->setBenefit($benefit);

        return $this;
    }

    /**
     * @param PictureInterface $picture
     * @return GalleryBuilderInterface
     */
    public function withPicture(PictureInterface $picture): GalleryBuilderInterface
    {
        $this->gallery->setPictures($picture);

        return $this;
    }

    /**
     * @param ArticleInterface $article
     * @return GalleryBuilderInterface
     */
    public function withArticle(ArticleInterface $article): GalleryBuilderInterface
    {
        $this->gallery->setArticle($article);

        return $this;
    }

    /**
     * @return GalleryInterface
     */
    public function getGallery(): GalleryInterface
    {
        return $this->gallery;
    }

}