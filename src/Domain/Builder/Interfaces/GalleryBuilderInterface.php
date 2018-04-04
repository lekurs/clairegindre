<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 21:45
 */

namespace App\Domain\Builder\Interfaces;


use App\Entity\Interfaces\BenefitInterface;
use App\Entity\Interfaces\GalleryInterface;
use App\Entity\Interfaces\UserInterface;

interface GalleryBuilderInterface
{
    /**
     * @param string $title
     * @param UserInterface $user
     * @param BenefitInterface $benefit
     * @return mixed
     */
    public function create(string $title, UserInterface $user, BenefitInterface $benefit);

    /**
     * @return GalleryInterface
     */
    public function getGallery(): GalleryInterface;

}