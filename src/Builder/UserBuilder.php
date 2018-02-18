<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 10:35
 */

namespace App\Builder;

use App\Builder\Interfaces\UserBuilderInterface;
use App\Entity\Picture;
use App\Entity\User;

class UserBuilder implements UserBuilderInterface
{
    /**
     * @var User
     */
    private $user;

    public function create(): UserBuilderInterface
    {
        $this->user = new User();

        return $this;
    }

    public function withPassword(string $password): UserBuilderInterface
    {
        $this->user->setPassword($password);

        return $this;
    }

    public function withPicture(Picture $picture): UserBuilderInterface
    {
        $this->user->setPicture($picture);

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}