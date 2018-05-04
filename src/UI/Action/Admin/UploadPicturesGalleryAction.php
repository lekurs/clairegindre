<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 20:52
 */

namespace App\UI\Action\Admin;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Models\Gallery;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Services\PictureUploaderHelper;
use App\UI\Action\Admin\Interfaces\UploadPicturesGalleryActionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UploadPicturesGalleryAction
 *
 * @Route(
 *     name="uploadImages",
 *     path="admin/gallery/pictures/upload",
 *     methods={"POST"}
 * )
 *
 */
class UploadPicturesGalleryAction implements UploadPicturesGalleryActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var PictureBuilderInterface
     */
    private $pictureBuilder;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * @var PictureUploaderHelper
     */
    private $pictureUploaderHelper;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $targetDir;

    /**
     * UploadPicturesGalleryAction constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param PictureBuilderInterface $pictureBuilder
     * @param GalleryBuilderInterface $galleryBuilder
     * @param PictureRepositoryInterface $pictureRepository
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param Filesystem $fileSystem
     * @param string $targetDir
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository, FormFactoryInterface $formFactory, PictureBuilderInterface $pictureBuilder, GalleryBuilderInterface $galleryBuilder, PictureRepositoryInterface $pictureRepository, PictureUploaderHelper $pictureUploaderHelper, Filesystem $fileSystem, string $targetDir)
    {
        $this->galleryRepository = $galleryRepository;
        $this->formFactory = $formFactory;
        $this->pictureBuilder = $pictureBuilder;
        $this->galleryBuilder = $galleryBuilder;
        $this->pictureRepository = $pictureRepository;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
        $this->fileSystem = $fileSystem;
        $this->targetDir = $targetDir;
    }


    public function __invoke(Request $request)
    {
        $gallery = $this->galleryRepository->getOne($request->request->get('gallery'));

        $this->pictureUploaderHelper->move(
                                                                            $request->files->get('picture'),
                                                                            $this->targetDir . '/gallery/' . str_replace(' ', '_', strtolower($request->request->get('destination'))),
                                                                            $request->files->get('picture')->getClientOriginalName()
                                                                        );

        $this->pictureBuilder->create(
                                                                $request->files->get('picture')->getClientOriginalName(),
                                                                'images/upload/gallery/' . $request->request->get('destination'),
                                                                $request->files->get('picture')->guessClientExtension(),
                                                                $request->request->get('order'),
                                                                $request->request->get('favorite'), $gallery
                                                            );

        $this->pictureRepository->save($this->pictureBuilder->getPicture());

        return new JsonResponse([], 201);
    }
}
