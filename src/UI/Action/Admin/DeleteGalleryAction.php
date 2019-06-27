<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 15:52
 */

namespace App\UI\Action\Admin;

use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;
use App\UI\Action\Admin\Interfaces\DeleteGalleryActionInterface;
use App\UI\Responder\Admin\Interfaces\DeleteGalleryResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class DeleteGalleryAction
 *
 * @Route(
 *     name="adminDeleteGallery",
 *     path="admin/gallery/del/{slug}"
 * )
 *
 * @package App\UI\Action\Admin
 */
final class DeleteGalleryAction implements DeleteGalleryActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $dirGallery;

    /**
     * @var string
     */
    private $dirPicture;

    /**
     * @var FileHelperInterface
     */
    private $fileHelper;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var AuthenticationErrorsResponder
     */
    private $errorResponder;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * DeleteGalleryAction constructor.
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
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->fileSystem = $fileSystem;
        $this->dirGallery = $dirGallery;
        $this->dirPicture = $dirPicture;
        $this->fileHelper = $fileHelper;
        $this->authorizationChecker = $authorizationChecker;
        $this->errorResponder = $errorResponder;
        $this->session = $session;
    }


    /**
     * @param Request $request
     * @param DeleteGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteGalleryResponderInterface $responder)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $gallery = $this->galleryRepository->getOne($request->get('slug'));

            foreach($gallery->getPictures() as $picture) {

                $gallery->getPictures()->removeElement($picture);

//                $this->fileHelper->deleteDirectory($gallery->getSlug(), $picture->getPictureName());
            }

            $this->fileSystem->remove($this->dirGallery .  $gallery->getSlug());

            $this->galleryRepository->delete($gallery);

            $this->session->getFlashBag()->add('success', 'La galerie à été supprimée');

            return $responder();

        } else {
            $error = $this->errorResponder;

            return $error();
        }
    }
}
