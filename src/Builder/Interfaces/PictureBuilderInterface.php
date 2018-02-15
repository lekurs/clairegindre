<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 11:37
 */

namespace App\Builder\Interfaces;


use App\Entity\Picture;
use App\Entity\User;

interface PictureBuilderInterface
{
    public function create(): PictureInterface;

    public function withName(string $uname): PictureBuilderInterface;

    public function withPath(string $path): PictureBuilderInterface;

    public function withExtension(string $extension): PictureBuilderInterface;

    public function withBenefitFamily(Benefit $benefit): PictureBuilderInterface;

    public function withUserId(User $userId): PictureBuilderInterface;

    public function getPicture():Picture;
}