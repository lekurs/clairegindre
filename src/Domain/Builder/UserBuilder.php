<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 10:35
 */

namespace App\Domain\Builder;

use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Picture;
use App\Domain\Models\User;


class UserBuilder implements UserBuilderInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $password
     * @param \DateTime $dateTime
     * @param PictureInterface $picture
     * @param $role
     * @return UserBuilderInterface
     */
  public function create(string $email, string $username, string $lastName, string $password, \DateTime $dateTime, PictureInterface $picture, $role): UserBuilderInterface
  {
      $this->user = new User($email, $username, $lastName, $password, $dateTime, $picture, $role);

      return $this;
  }

    public function withId(int $user): UserBuilderInterface
    {
        $this->user->setId($user);

        return $this;
    }

    public function withPassword(string $password): UserBuilderInterface
    {
        $this->user->setPlainPassword($password);

        return $this;
    }

    public function withPicture(Picture $picture): UserBuilderInterface
    {
        $this->user->setPicture($picture);

        return $this;
    }

    public function withRole($role): UserBuilderInterface
    {
        $this->user->setRoles($role);

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}