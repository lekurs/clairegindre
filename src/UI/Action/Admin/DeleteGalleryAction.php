<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 15:52
 */

namespace App\UI\Action\Admin;

use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Infra\GCP\Storage\Helper\Interfaces\StorageWriterInterface;
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
     * @var StorageWriterInterface
     */
    private $storageWriter;

    /**
     * DeleteGalleryAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param Filesystem $fileSystem
     * @param string $dirGallery
     * @param string $dirPicture
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        Filesystem $fileSystem,
        string $dirGallery,
        string $dirPicture,
        StorageWriterInterface $storageWriter
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->fileSystem = $fileSystem;
        $this->dirGallery = $dirGallery;
        $this->dirPicture = $dirPicture;
        $this->storageWriter = $storageWriter;
    }

    /**
     * @param Request $request
     * @param DeleteGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getOne($request->get('slug'));

        $this->storageWriter->deleteBucket($gallery->getSlug());

        die;

        foreach($gallery->getPictures() as $picture) {

            $gallery->getPictures()->removeElement($picture);

        }

        $this->fileSystem->remove($this->dirGallery .  $gallery->getSlug());

        $this->galleryRepository->delete($gallery);

        return $responder();
    }
}
