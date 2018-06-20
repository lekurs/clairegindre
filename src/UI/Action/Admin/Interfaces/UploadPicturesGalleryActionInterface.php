<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 20:53
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;
use App\Services\PictureUploaderHelper;
use App\Services\SlugHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface UploadPicturesGalleryActionInterface
{
    /**
     * UploadPicturesGalleryActionInterface constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param PictureBuilderInterface $pictureBuilder
     * @param GalleryBuilderInterface $galleryBuilder
     * @param PictureRepositoryInterface $pictureRepository
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param Filesystem $fileSystem
     * @param string $dirGallery
     * @param SlugHelper $stringReplaceService
     * @param string $dirPicture
     * @param FileHelperInterface $fileHelper
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        FormFactoryInterface $formFactory,
        PictureBuilderInterface $pictureBuilder,
        GalleryBuilderInterface $galleryBuilder,
        PictureRepositoryInterface $pictureRepository,
        PictureUploaderHelper $pictureUploaderHelper,
        Filesystem $fileSystem,
        string $dirGallery,
        SlugHelper $stringReplaceService,
        string  $dirPicture,
        FileHelperInterface $fileHelper,
        string $urlStorage
    );

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request);
}
