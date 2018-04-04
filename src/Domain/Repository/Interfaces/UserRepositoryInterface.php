<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:41
 */

namespace App\Domain\Repository\Interfaces;


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
}