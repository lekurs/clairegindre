<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 11:54
 */

namespace App\Builder;

use App\Builder\Interfaces\PictureBuilderInterface;
use App\Builder\Interfaces\PictureInterface;
use App\Entity\Picture;

class PictureBuilder implements PictureBuilderInterface
{
    /**
     * @var Picture
     */
    private $picture;

    public function create(): PictureBuilderInterface
    {
        $this->picture = new Picture();

        return $this;
    }

    public function withName(string $name): PictureBuilderInterface
    {
        $this->picture->setPictureName($name);

        return $this;
    }

    public function withExtension(string $extension): PictureBuilderInterface
    {
        $this->picture->setExtension($extension);

        return $this;
    }

    public function withPath(string $path): PictureBuilderInterface
    {
        $this->picture->setPicturePath($path);

        return $this;
    }

    public function withBenefit(string $benefit): PictureBuilderInterface
    {
        $this->picture->setBenefitFamily($benefit);

        return $this;
    }

    public function withUserName(string $userName): PictureBuilderInterface
    {
        $this->picture->setUserName($userName);

        return $this;
    }

    public function getPicture(): Picture
    {
        return $this->picture;
    }

}