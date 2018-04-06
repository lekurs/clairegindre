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

class GalleryCreationDTO implements GalleryCreationDTOInterface
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
     * GalleryCreationDTO constructor.
     *
     * @param BenefitInterface $benefit
     * @param string $title
     * @param $pictures
     */
    public function __construct(
        BenefitInterface $benefit,
        string $title,
        array $pictures
    ) {
        $this->benefit = $benefit;
        $this->title = $title;
        $this->pictures = $pictures;
    }
}
