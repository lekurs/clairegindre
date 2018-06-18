<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 22:29
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\GalleryCreationDTOInterface;
use App\Domain\Models\Interfaces\BenefitInterface;

final class GalleryCreationDTO implements GalleryCreationDTOInterface
{
    /**
     * @var BenefitInterface
     */
    public $benefit;

    /**
     * @var string
     */
    public $title;

    /**
     * @var \SplFileInfo[]
     */
    public $pictures;

    /**
     * @var string
     */
    public $user;

    /**
     * @var \DateTime
     */
    public $eventDate;

    /**
     * @var string
     */
    public $eventPlace;

    /**
     * GalleryCreationDTO constructor.
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
    ) {
        $this->benefit = $benefit;
        $this->title = $title;
        $this->user = $user;
        $this->eventDate = $eventDate;
        $this->eventPlace = $eventPlace;
    }
}
