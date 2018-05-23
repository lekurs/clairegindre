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
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
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
 *     path="admin/gallery/edit/{slug}"
 * )
 *
 * @package App\UI\Action\Admin
 */
class EditGalleryAction implements EditGalleryActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var PictureEditTypeHandlerInterface
     */
    private $pictureEditTypeHandler;

    /**
     * EditGalleryAction constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     * @param PictureRepositoryInterface $pictureRepository
     * @param FormFactoryInterface $formFactory
     * @param PictureEditTypeHandlerInterface $pictureEditTypeHandler
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository, PictureRepositoryInterface $pictureRepository, FormFactoryInterface $formFactory, PictureEditTypeHandlerInterface $pictureEditTypeHandler)
    {
        $this->galleryRepository = $galleryRepository;
        $this->pictureRepository = $pictureRepository;
        $this->formFactory = $formFactory;
        $this->pictureEditTypeHandler = $pictureEditTypeHandler;
    }


    public function __invoke(Request $request, EditGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getWithPictures($request->attributes->get('slug'));

        $form = $this->formFactory->create(GalleryOrderType::class, $gallery)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            foreach ($form->getData()->getPictures() as $pictures)
            {
                $this->pictureRepository->update();
            }
            return $responder(true, $form, $gallery);
        }

        return $responder(false, $form, $gallery);
    }
}