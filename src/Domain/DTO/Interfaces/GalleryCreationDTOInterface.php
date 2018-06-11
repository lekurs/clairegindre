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
     * @param string $user
     * @param \DateTime $eventDate
     * @param string $eventPlace
     */
    public function __construct(
        BenefitInterface $benefit,
        string $title,
        string $user,
        \DateTime $eventDate,
        string $eventPlace
    );
}
