<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 15:52
 */

namespace App\UI\Action\Admin;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Models\Gallery;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Services\PictureUploaderHelper;
use App\UI\Action\Admin\Interfaces\DeleteGalleryActionInterface;
use App\UI\Responder\Admin\Interfaces\DeleteGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
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
class DeleteGalleryAction implements DeleteGalleryActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * DeleteGalleryAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param GalleryBuilderInterface $galleryBuilder
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        GalleryBuilderInterface $galleryBuilder
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->galleryBuilder = $galleryBuilder;
    }


    public function __invoke(Request $request, DeleteGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getOne($request->get('slug'));

        foreach($gallery->getPictures() as $picture) {
            $gallery->getPictures()->removeElement($picture);
        }

        $this->entityManager->remove($gallery);
        $this->entityManager->flush();

        return $responder();
    }


}