<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 10:33
 */

namespace App\Builder\Interfaces;


use App\Entity\User;

interface UserBuilderInterface
{
    public function create(): UserBuilderInterface;

    public function withPassword(string $password): UserBuilderInterface;

    public function withPicture(string $picture): UserBuilderInterface;

    public function getUser(): User;
}