<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 23/06/2018
 * Time: 12:51
 */

namespace App\UI\Action\Admin;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Action\Admin\Interfaces\UpdateGalleryOnlineAjaxActionInterface;
use App\UI\Responder\Admin\Interfaces\UpdateGalleryOnlineAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateGalleryOnlineAjaxAction
 * @Route(
 *     name="adminUpdateOnlineGallery",
 *     path="admin/gallery/status",
 *     methods={ "POST" }
 * )
 */
final class UpdateGalleryOnlineAjaxAction implements UpdateGalleryOnlineAjaxActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * UpdateGalleryOnlineAjaxAction constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function __invoke(Request $request, UpdateGalleryOnlineAjaxResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getOneById($request->request->get('id'));

        $this->galleryRepository->updateOnline($gallery);

        return $responder();
    }
}
