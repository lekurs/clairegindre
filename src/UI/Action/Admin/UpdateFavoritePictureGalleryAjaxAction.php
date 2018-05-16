<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 23:18
 */

namespace App\UI\Action\Admin;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Action\Admin\Interfaces\UpdateFavoritePictureGalleryAjaxActionInterface;
use App\UI\Responder\Interfaces\UpdateFavoritePictureGalleryResponderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateFavoritePictureGalleryAjaxAction
 *
 * @Route(
 *     name="adminEditFavoritePicture",
 *     path="admin/gallery/pictures/{gallerySlug}/favorite",
 *     methods={"POST"}
 * )
 *
 */
class UpdateFavoritePictureGalleryAjaxAction implements UpdateFavoritePictureGalleryAjaxActionInterface
{
    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * UpdateFavoritePictureGalleryAjaxAction constructor.
     *
     * @param PictureRepositoryInterface $pictureRepository
     */
    public function __construct(PictureRepositoryInterface $pictureRepository)
    {
        $this->pictureRepository = $pictureRepository;
    }

    /**
     * @param Request $request
     * @param UpdateFavoritePictureGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UpdateFavoritePictureGalleryResponderInterface $responder)
    {
        $pictureToFavorite = $this->pictureRepository->getOne($request->request->get('id'));

        $oldPictureFavorite = $this->pictureRepository->getFavorite($pictureToFavorite->getGallery());

        $this->pictureRepository->updateFavorite($oldPictureFavorite, $pictureToFavorite);

        return $responder();
    }
}
