<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 10:33
 */

namespace App\Domain\Builder\Interfaces;


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
     * @param $role
     * @return UserBuilderInterface
     */
    public function create(string $email, string $username, string $lastName, string $password, \DateTime $dateTime, $role): UserBuilderInterface;

    /**
     * @param int $user
     * @return UserBuilderInterface
     */
    public function withId(int $user): UserBuilderInterface;

    /**
     * @param string $password
     * @return UserBuilderInterface
     */
    public function withPassword(string $password): UserBuilderInterface;

    /**
     * @param Picture $picture
     * @return UserBuilderInterface
     */
    public function withPicture(Picture $picture): UserBuilderInterface;

    /**
     * @return User
     */
    public function getUser(): User;
}