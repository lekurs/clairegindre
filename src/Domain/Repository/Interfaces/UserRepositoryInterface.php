<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:41
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param $username
     * @return mixed
     */
    public function loadUserByUsername($username);

    /**
     * @param $id
     * @return User
     */
    public function getOne($id): User;

    /**
     * @return mixed
     */
    public function showGalleryByUser();

    /**
     * @param int $first
     * @param int $max
     * @return mixed
     */
    public function showGalleryByUserWithPagination(int $first, int $max);

    /**
     * @param UserInterface $user
     */
    public function save(UserInterface $user): void;
}