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
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Action\Admin\Interfaces\UploadPicturesGalleryActionInterface;
use Doctrine\ORM\EntityManagerInterface;
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
     * @var EntityManagerInterface
     */
    private $entityManager;

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
     * UploadPicturesGalleryAction constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param PictureBuilderInterface $pictureBuilder
     * @param GalleryBuilderInterface $galleryBuilder
     * @param PictureRepositoryInterface $pictureRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        PictureBuilderInterface $pictureBuilder,
        GalleryBuilderInterface $galleryBuilder,
        PictureRepositoryInterface $pictureRepository
    ) {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->pictureBuilder = $pictureBuilder;
        $this->galleryBuilder = $galleryBuilder;
        $this->pictureRepository = $pictureRepository;
    }


    public function __invoke(Request $request)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->find($request->request->get('gallery'));

        move_uploaded_file($_FILES['picture']['tmp_name'],  'images/upload/gallery/' .$request->request->get('destination') . '/' .$_FILES['picture']['name']);

        $pathInfo = pathinfo($_FILES['picture']['name']);

        $this->pictureBuilder->create($_FILES['picture']['name'], 'images/upload/gallery/' . $request->request->get('destination'), $pathInfo['extension'], $request->request->get('order'), $request->request->get('favorite'), $gallery);

        $this->pictureRepository->save($this->pictureBuilder->getPicture());

        return new JsonResponse([], 201);
    }
}
