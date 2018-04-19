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
 *     path="admin/gallery/del/{id}"
 * )
 *
 * @package App\UI\Action\Admin
 */
class DeleteGalleryAction implements DeleteGalleryActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * DeleteGalleryAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param GalleryBuilderInterface $galleryBuilder
     */
    public function __construct(EntityManagerInterface $entityManager, GalleryBuilderInterface $galleryBuilder)
    {
        $this->entityManager = $entityManager;
        $this->galleryBuilder = $galleryBuilder;
    }

    public function __invoke(Request $request, DeleteGalleryResponderInterface $responder)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->find($request->get('id'));

        foreach($gallery->getPictures() as $picture) {
            $gallery->getPictures()->removeElement($picture);
        }

        $this->entityManager->remove($gallery);
        $this->entityManager->flush();

        return $responder();
    }


}