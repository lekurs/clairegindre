<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 12:40
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\GalleryMakerInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface GalleryMakerRepositoryInterface
{
    /**
     * GalleryMakerRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param GalleryMakerInterface $galleryMaker
     * @param PictureInterface $picture
     * @return mixed
     */
    public function save(GalleryMakerInterface $galleryMaker, PictureInterface $picture);

    /**
     * @return mixed
     */
    public function update();
}
