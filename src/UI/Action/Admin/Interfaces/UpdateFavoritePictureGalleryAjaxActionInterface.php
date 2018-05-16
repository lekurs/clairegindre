<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 23:21
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Responder\Interfaces\UpdateFavoritePictureGalleryResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface UpdateFavoritePictureGalleryAjaxActionInterface
{
    /**
     * UpdateFavoritePictureGalleryAjaxActionInterface constructor.
     *
     * @param PictureRepositoryInterface $pictureRepository
     */
    public function __construct(PictureRepositoryInterface $pictureRepository);

    /**
     * @param Request $request
     * @param UpdateFavoritePictureGalleryResponderInterface $responder
     * @return UpdateFavoritePictureGalleryResponderInterface
     */
    public function __invoke(Request $request, UpdateFavoritePictureGalleryResponderInterface $responder);
}