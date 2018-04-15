<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:29
 */

namespace App\Domain\DTO\Interfaces;

use App\Domain\Models\Interfaces\BenefitInterface;
interface GalleryCreationDTOInterface
{
    /**
     * GalleryCreationDTOInterface constructor.
     *
     * @param BenefitInterface $benefit
     * @param string $title
     * @param array $pictures
     */
    public function __construct(
        BenefitInterface $benefit,
        string $title,
        array $pictures
    );

}