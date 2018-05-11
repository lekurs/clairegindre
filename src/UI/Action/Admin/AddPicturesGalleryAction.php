<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 17:04
 */

namespace App\UI\Action\Admin;


use App\Domain\Models\Gallery;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Services\StringReplaceUrlHelper;
use App\UI\Action\Admin\Interfaces\AddPicturesGalleryActionInterface;
use App\UI\Responder\Admin\Interfaces\AddPicturesGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
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
     * @var StringReplaceUrlHelper
     */
    private $replaceService;

    /**
     * AddPicturesGalleryAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        StringReplaceUrlHelper $replaceService
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->replaceService = $replaceService;
    }


    public function __invoke(Request $request, AddPicturesGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getOne($request->get('slug'));

        return $responder(false, $gallery);
    }

}