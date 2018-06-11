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
use App\Services\PictureUploaderHelper;
use App\Services\SlugHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface UploadPicturesGalleryActionInterface
{
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
        string  $dirPicture
    );

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request);
}
