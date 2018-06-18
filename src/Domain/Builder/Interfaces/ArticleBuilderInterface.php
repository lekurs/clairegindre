<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:35
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\UserInterface;

interface ArticleBuilderInterface
{
    /**
     * @param string $title
     * @param string $content
     * @param \DateTime $creationDate
     * @param bool $online
     * @param UserInterface $user
     * @param string $personnalButton
     * @param GalleryInterface $gallery
     * @param BenefitInterface $prestation
     * @return mixed
     */
//    public function create(string $title, string $content, \DateTime $creationDate, bool $online, UserInterface $user, string $personnalButton, GalleryInterface $gallery, BenefitInterface $prestation);

    public function getArticle():ArticleInterface;

}