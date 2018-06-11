<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 17:05
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Services\SlugHelper;
use App\UI\Responder\Admin\Interfaces\AddPicturesGalleryResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddPicturesGalleryActionInterface
{
    /**
     * AddPicturesGalleryActionInterface constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param PictureRepositoryInterface $pictureRepository
     * @param SlugHelper $replaceService
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        PictureRepositoryInterface $pictureRepository,
        SlugHelper $replaceService
    );

    /**
     * @param Request $request
     * @param AddPicturesGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddPicturesGalleryResponderInterface $responder);
}
