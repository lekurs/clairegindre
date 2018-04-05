<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:41
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\UserInterface;

interface UserRepositoryInterface
{
    /**
     * @param $username
     * @return mixed
     */
    public function loadUserByUsername($username);

    /**
     * @return mixed
     */
    public function showGalleryByUser();

    /**
     * @param UserInterface $user
     */
    public function save(UserInterface $user): void;
}