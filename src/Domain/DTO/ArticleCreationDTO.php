<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:14
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\ArticleCreationDTOInterface;
use App\Domain\Models\Interfaces\BenefitInterface;
use App\Domain\Models\Interfaces\GalleryInterface;

final class ArticleCreationDTO implements ArticleCreationDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var GalleryInterface
     */
    public $gallery;

    /**
     * @var bool
     */
    public $online;

    /**
     * @var string
     */
    public $personnalButton;

    /**
     * @var BenefitInterface
     */
    public $prestation;

    /**
     * ArticleCreationDTO constructor.
     *
     * @param string $title
     * @param string $content
     * @param bool $online
     * @param string $personnalButton
     * @param BenefitInterface $prestation
     */
    public function __construct(
        string $title,
        string $content,
        string $personnalButton,
        bool $online,
        BenefitInterface $prestation
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->personnalButton = $personnalButton;
        $this->online = $online;
        $this->prestation = $prestation;
    }
}
