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
     * @param $titleGallery
     * @return mixed
     */
    public function getWithPictures($titleGallery);

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
     * @param $idUser
     * @param $idGallery
     * @return mixed
     */
    public function getGalleryByUserAndId($idUser, $idGallery);

    /**
     * @param int $first
     * @param int $max
     * @return mixed
     */
    public function getAllWithPaginator(int $first, int $max);

    /**
     * @param GalleryInterface $gallery
     * @return mixed
     */
    public function save(GalleryInterface $gallery);

    /**
     * @param GalleryInterface $gallery
     * @return mixed
     */
    public function delete(GalleryInterface $gallery);

}