<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:14
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Gallery;
use App\Domain\Models\Interfaces\PictureInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface PictureRepositoryInterface
{
    /**
     * PictureRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param $id
     * @return mixed
     */
    public function getOne($id);

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function getAllByGallery(Gallery $gallery);

    /**
     * @return mixed
     */
    public function showPicturesByGallery();

    /**
     * @param $galleryId
     * @return mixed
     */
    public function getFavorite($galleryId);

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function getWithGalerieMaker(Gallery $gallery);

    /**
     * @param PictureInterface $picture
     * @return mixed
     */
    public function save(PictureInterface $picture);

    /**
     * @return mixed
     */
    public function update();

    /**
     * @param PictureInterface $picture
     * @return mixed
     */
    public function delete(PictureInterface $picture);

    /**
     * @param $oldPicture
     * @param $pictureFavorite
     * @return mixed
     */
    public function updateFavorite($oldPicture, $pictureFavorite);
}