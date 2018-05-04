<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 22:18
 */

namespace App\UI\Action\Admin;


use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Action\Admin\Interfaces\DeletePictureGalleryAjaxActionInterface;
use App\UI\Responder\Admin\Interfaces\DeletePictureGalleryAjaxResponderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
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
class DeletePictureGalleryAjaxAction implements DeletePictureGalleryAjaxActionInterface
{
    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * @var PictureBuilderInterface
     */
    private $pictureBuilder;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $targetDirPublic;

    /**
     * DeletePictureGalleryAjaxAction constructor.
     * @param PictureRepositoryInterface $pictureRepository
     * @param PictureBuilderInterface $pictureBuilder
     * @param Filesystem $fileSystem
     * @param string $targetDirPublic
     */
    public function __construct(PictureRepositoryInterface $pictureRepository, PictureBuilderInterface $pictureBuilder, Filesystem $fileSystem, string $targetDirPublic)
    {
        $this->pictureRepository = $pictureRepository;
        $this->pictureBuilder = $pictureBuilder;
        $this->fileSystem = $fileSystem;
        $this->targetDirPublic = $targetDirPublic;
    }


    public function __invoke(Request $request, DeletePictureGalleryAjaxResponderInterface $responder)
    {
        //Récupérer l'objet image en bdd
        $picture = $this->pictureRepository->getOne($request->request->get('id'));

        $this->fileSystem->remove($this->targetDirPublic . '/' .$picture->getPublicPath(). '/' .$picture->getPictureName());

        $this->pictureRepository->delete($picture);

        return $responder();
    }
}
