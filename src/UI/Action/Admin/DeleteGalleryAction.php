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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * DeleteGalleryAction constructor.
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
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->fileSystem = $fileSystem;
        $this->dirGallery = $dirGallery;
        $this->dirPicture = $dirPicture;
        $this->fileHelper = $fileHelper;
    }

    /**
     * @param Request $request
     * @param DeleteGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getOne($request->get('slug'));

        foreach($gallery->getPictures() as $picture) {

            $gallery->getPictures()->removeElement($picture);
        }

        $this->fileSystem->remove($this->dirGallery .  $gallery->getSlug());

        $this->galleryRepository->delete($gallery);

        return $responder();
    }
}
