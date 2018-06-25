<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 22:19
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Responder\Admin\Interfaces\DeletePictureGalleryAjaxResponderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface DeletePictureGalleryAjaxActionInterface
{
    /**
     * DeletePictureGalleryAjaxActionInterface constructor.
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
    );

    /**
     * @param Request $request
     * @param DeletePictureGalleryAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeletePictureGalleryAjaxResponderInterface $responder);
}
