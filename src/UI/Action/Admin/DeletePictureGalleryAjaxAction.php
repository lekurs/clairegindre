<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 22:18
 */

namespace App\UI\Action\Admin;

use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Action\Admin\Interfaces\DeletePictureGalleryAjaxActionInterface;
use App\UI\Responder\Admin\Interfaces\DeletePictureGalleryAjaxResponderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeletePictureGalleryAjaxAction
 *
 * @Route(
 *     name="adminDeletePictureGallery",
 *     path="admin/gallery/pictures/delete",
 *     methods={"POST"}
 * )
 *
 */
final class DeletePictureGalleryAjaxAction implements DeletePictureGalleryAjaxActionInterface
{
    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $targetDirPublic;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * DeletePictureGalleryAjaxAction constructor.
     *
     * @param PictureRepositoryInterface $pictureRepository
     * @param Filesystem $fileSystem
     * @param string $targetDirPublic
     * @param SessionInterface $session
     */
    public function __construct(
        PictureRepositoryInterface $pictureRepository,
        Filesystem $fileSystem,
        string $targetDirPublic,
        SessionInterface $session
    ) {
        $this->pictureRepository = $pictureRepository;
        $this->fileSystem = $fileSystem;
        $this->targetDirPublic = $targetDirPublic;
        $this->session = $session;
    }

    /**
     * @param Request $request
     * @param DeletePictureGalleryAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeletePictureGalleryAjaxResponderInterface $responder)
    {
        $picture = $this->pictureRepository->getOne($request->request->get('id'));

        $this->fileSystem->remove($this->targetDirPublic . '/' .$picture->getPublicPath(). '/' .$picture->getPictureName());

        $this->pictureRepository->delete($picture);

        $this->session->getFlashBag()->add('success', 'La galerie a été supprimée');

        return $responder();
    }
}
