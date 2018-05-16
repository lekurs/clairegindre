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
 *     path="admin/gallery/pictures/favorite",
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
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var PictureBuilderInterface
     */
    private $pictureBuilder;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $targetDirPublic;

    /**
     * UpdateFavoritePictureGalleryAjaxAction constructor.
     * @param PictureRepositoryInterface $pictureRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param PictureBuilderInterface $pictureBuilder
     * @param GalleryBuilderInterface $galleryBuilder
     * @param Filesystem $fileSystem
     * @param string $targetDirPublic
     */
    public function __construct(PictureRepositoryInterface $pictureRepository, GalleryRepositoryInterface $galleryRepository, PictureBuilderInterface $pictureBuilder, GalleryBuilderInterface $galleryBuilder, Filesystem $fileSystem, string $targetDirPublic)
    {
        $this->pictureRepository = $pictureRepository;
        $this->galleryRepository = $galleryRepository;
        $this->pictureBuilder = $pictureBuilder;
        $this->galleryBuilder = $galleryBuilder;
        $this->fileSystem = $fileSystem;
        $this->targetDirPublic = $targetDirPublic;
    }


    public function __invoke(Request $request, UpdateFavoritePictureGalleryResponderInterface $responder)
    {
        $picture = $this->pictureRepository->getOne($request->request->get('id'));

        $pictureInGallery = $this->galleryRepository->getWithPictures($picture->getGallery()->getid()); //TODO

        $this->galleryRepository->update($pictureInGallery);

        //remettre à 0 les images avec un favori à 1

    }
}
