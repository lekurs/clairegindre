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
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

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
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param AuthenticationErrorsResponder $errorResponder
     * @param SessionInterface $session
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        Filesystem $fileSystem,
        string $dirGallery,
        string $dirPicture,
        FileHelperInterface $fileHelper,
        AuthorizationCheckerInterface $authorizationChecker,
        AuthenticationErrorsResponder $errorResponder,
        SessionInterface $session
    );

    /**
     * @param Request $request
     * @param DeleteGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteGalleryResponderInterface $responder);
}
