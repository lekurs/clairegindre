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
     * @param $id
     * @return User
     */
    public function getOneById($id): User;

    /**
     * @param $email
     * @return mixed
     */
    public function getAdmin($email);

    /**
     * @return array
     */
    public function showAll(): array;

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

    /**
     * @return mixed
     */
    public function update();

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function updateOnline(UserInterface $user);
}
