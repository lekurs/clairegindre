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
     * @var string
     */
    public $slug;

    /**
     * EditArticleTypeDTO constructor.
     * @param string $title
     * @param string $content
     * @param bool $online
     * @param string $personnalButton
     * @param BenefitInterface $prestation
     * @param string $slug
     */
    public function __construct(string $title, string $content, bool $online, string $personnalButton, BenefitInterface $prestation, string $slug)
    {
        $this->title = $title;
        $this->content = $content;
        $this->online = $online;
        $this->personnalButton = $personnalButton;
        $this->prestation = $prestation;
        $this->slug = $slug;
    }
}
