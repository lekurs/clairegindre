<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 15:52
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;
use App\UI\Responder\Admin\Interfaces\DeleteGalleryResponderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

interface DeleteGalleryActionInterface
{
    /**
     * DeleteGalleryActionInterface constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param Filesystem $fileSystem
     * @param string $dirGallery
     * @param string $dirPicture
     * @param FileHelperInterface $fileHelper
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        Filesystem $fileSystem,
        string $dirGallery,
        string $dirPicture,
        FileHelperInterface $fileHelper
    );

    /**
     * @param Request $request
     * @param DeleteGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteGalleryResponderInterface $responder);
}
