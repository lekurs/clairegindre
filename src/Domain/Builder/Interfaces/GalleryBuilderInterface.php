<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 21:45
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\BenefitInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;

interface GalleryBuilderInterface
{
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
    public function create(string $title, UserInterface $user, \DateTime $eventDate, string $eventPlace, BenefitInterface $benefit, string $slug, \Datetime $creationDate, ArticleInterface $article = null, bool $online = true): GalleryBuilderInterface;

    /**
     * @param PictureInterface $picture
     * @return GalleryBuilderInterface
     */
    public function withPicture(PictureInterface $picture): GalleryBuilderInterface;

    /**
     * @param ArticleInterface $article
     * @return GalleryBuilderInterface
     */
    public function withArticle(ArticleInterface $article): GalleryBuilderInterface;

    /**
     * @return GalleryInterface
     */
    public function getGallery(): GalleryInterface;

}