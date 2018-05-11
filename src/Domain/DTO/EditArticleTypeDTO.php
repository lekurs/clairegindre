<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 18:38
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\EditArticleTypeDTOInterface;
use App\Domain\Models\Interfaces\BenefitInterface;

final class EditArticleTypeDTO implements EditArticleTypeDTOInterface
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
     * EditArticleTypeDTO constructor.
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
        bool $online,
        string $personnalButton,
        BenefitInterface $prestation
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->online = $online;
        $this->personnalButton = $personnalButton;
        $this->prestation = $prestation;
    }
}
