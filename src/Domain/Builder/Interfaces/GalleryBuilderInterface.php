<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 21:45
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Interfaces\BenefitInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\UserInterface;

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