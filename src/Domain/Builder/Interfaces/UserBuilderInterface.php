<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 10:33
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Picture;
use App\Domain\Models\User;

interface UserBuilderInterface
{
    /**
     * @param string $email
     * @param string $username
     * @param string $lastName
     * @param string $password
     * @param \DateTime $dateTime
     * @param PictureInterface $picture
     * @param bool $online
     * @param $role
     * @param string $slug
     * @return UserBuilderInterface
     */
//    public function create(string $email, string $username, string $lastName, string $password, \DateTime $dateTime, PictureInterface $picture, bool $online, $role, string $slug): UserBuilderInterface;

    /**
     * @return User
     */
    public function getUser(): User;
}