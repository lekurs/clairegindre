<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 14:35
 */

namespace App\Entity\Interfaces;


interface GalleryInterface
{
    /**
     * @return GalleryInterface
     */
    public function create(): GalleryInterface;

    /**
     * @return BenefitInterface
     */
    public function getBenefit(): BenefitInterface;

}