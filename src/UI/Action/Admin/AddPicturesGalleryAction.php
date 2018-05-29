<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 17:04
 */

namespace App\UI\Action\Admin;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Services\SlugHelper;
use App\UI\Action\Admin\Interfaces\AddPicturesGalleryActionInterface;
use App\UI\Responder\Admin\Interfaces\AddPicturesGalleryResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddPicturesGalleryAction
 *
 * @Route(
 *     name="adminAddPicturesGallery",
 *     path="admin/gallery/pictures/{slug}",
 *     methods={"GET"}
 * )
 *
 */
class AddPicturesGalleryAction implements AddPicturesGalleryActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * @var SlugHelper
     */
    private $replaceService;

    /**
     * AddPicturesGalleryAction constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     * @param PictureRepositoryInterface $pictureRepository
     * @param SlugHelper $replaceService
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository, PictureRepositoryInterface $pictureRepository, SlugHelper $replaceService)
    {
        $this->galleryRepository = $galleryRepository;
        $this->pictureRepository = $pictureRepository;
        $this->replaceService = $replaceService;
    }


    public function __invoke(Request $request, AddPicturesGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getOne($request->attributes->get('slug'));

        $pictures = $this->pictureRepository->getAllByGallery($gallery);

        return $responder(false, $gallery, $pictures);
    }
}
