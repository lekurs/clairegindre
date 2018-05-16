<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 13/04/2018
 * Time: 14:45
 */

namespace App\UI\Action\Admin;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\DTO\GalleryOrderDTO;
use App\Domain\Form\Type\GalleryOrderType;
use App\Domain\Form\Type\PictureEditType;
use App\Domain\Models\Gallery;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Picture;
use App\UI\Action\Admin\Interfaces\EditGalleryActionInterface;
use App\UI\Form\FormHandler\Interfaces\PictureEditTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\EditGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EditGalleryAction
 *
 * @Route(
 *     name="adminEditGallery",
 *     path="admin/gallery/edit/{id}"
 * )
 *
 * @package App\UI\Action\Admin
 */
class EditGalleryAction implements EditGalleryActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * @var PictureEditTypeHandlerInterface
     */
    private $pictureEditTypeHandler;

    /**
     * EditGalleryAction constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param GalleryBuilderInterface $galleryBuilder
     * @param PictureEditTypeHandlerInterface $pictureEditTypeHandler
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        GalleryBuilderInterface $galleryBuilder,
        PictureEditTypeHandlerInterface $pictureEditTypeHandler
    ) {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->galleryBuilder = $galleryBuilder;
        $this->pictureEditTypeHandler = $pictureEditTypeHandler;
    }


    public function __invoke(Request $request, EditGalleryResponderInterface $responder)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->getWithPictures($request->get('id')); // a modifier avec le titre de la galerie

        $form = $this->formFactory->create(GalleryOrderType::class, $gallery)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            foreach ($form->getData()->getPictures() as $pictures)
            {
                $this->entityManager->persist($pictures);
            }
            $this->entityManager->flush();

            return $responder(true, $form, $gallery);
        }

        return $responder(false, $form, $gallery);
    }
}