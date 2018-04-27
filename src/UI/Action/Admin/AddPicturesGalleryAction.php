<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 17:04
 */

namespace App\UI\Action\Admin;


use App\Domain\Models\Gallery;
use App\UI\Action\Admin\Interfaces\AddPicturesGalleryActionInterface;
use App\UI\Responder\Admin\Interfaces\AddPicturesGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddPicturesGalleryAction
 *
 * @Route(
 *     name="adminPictures",
 *     path="admin/gallery/{id}/pictures",
 *     methods={"GET"}
 * )
 *
 */
class AddPicturesGalleryAction implements AddPicturesGalleryActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AddPicturesGalleryAction constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, AddPicturesGalleryResponderInterface $responder)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->find($request->get('id'));

        return $responder(false, $gallery);
    }

}