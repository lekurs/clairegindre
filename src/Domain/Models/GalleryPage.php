<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:29
 */

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\GalleryPageInterface;
use Ramsey\Uuid\Uuid;

class GalleryPage implements GalleryPageInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $displayOrder;

    /**
     * @var string
     */
    private $images;

    /**
     * GalleryPage constructor.
     *
     * @param int $displayOrder
     * @param string $images
     */
    public function __construct(
        int $displayOrder,
        string $images
    ){
        $this->id = Uuid::uuid4();
        $this->displayOrder = $displayOrder;
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    /**
     * @return string
     */
    public function getImages(): string
    {
        return $this->images;
    }
}
