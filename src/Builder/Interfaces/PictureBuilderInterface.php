<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 11:37
 */

namespace App\Builder\Interfaces;


use App\Entity\Picture;

interface PictureBuilderInterface
{
    public function create(): PictureBuilderInterface;

    public function withName(string $name): PictureBuilderInterface;

    public function withPath(string $path): PictureBuilderInterface;

    public function withExtension(string $extension): PictureBuilderInterface;

    public function getPicture():Picture;
}