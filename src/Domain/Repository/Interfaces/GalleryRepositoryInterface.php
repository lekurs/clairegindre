<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:43
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\GalleryInterface;

interface GalleryRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getOne($id);

    /**
     * @return mixed
     */
    public function getAllWithPictures();

    /**
     * @param $id
     * @return mixed
     */
    public function getGalleryByUser($id);

    /**
     * @param GalleryInterface $gallery
     * @return mixed
     */
    public function save(GalleryInterface $gallery);

}