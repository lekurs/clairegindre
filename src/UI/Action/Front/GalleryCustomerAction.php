<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 15:56
 */

namespace App\UI\Action\Front;

use App\Domain\Form\Type\ContactType;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Action\Front\Interfaces\GalleryCustomerActionInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\GalleryCustomerResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GalleryCustomerAction
 *
 * @Route(
 *     name="galleryCustomer",
 *     path="/gallery/{slugUser}/{slugGallery}"
 * )
 *
 * @package App\UI\Action\Security
 */
final class GalleryCustomerAction implements GalleryCustomerActionInterface
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
     * @var ContactTypeHandlerInterface
     */
    private $contactTypeHandler;

    /**
     * GalleryCustomerAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param ContactTypeHandlerInterface $contactTypeHandler
     * @param PictureRepositoryInterface $pictureRepository
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        FormFactoryInterface $formFactory,
        ContactTypeHandlerInterface $contactTypeHandler,
        PictureRepositoryInterface $pictureRepository
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->formFactory = $formFactory;
        $this->contactTypeHandler = $contactTypeHandler;
        $this->pictureRepository = $pictureRepository;
    }


    /**
     * @param Request $request
     * @param GalleryCustomerResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, GalleryCustomerResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getWithPictures($request->attributes->get('slugGallery'));

        $contactForm = $this->formFactory->create(ContactType::class)->handleRequest($request);

        $pictures = $this->pictureRepository->getAllByGallery($gallery);

        if ($this->contactTypeHandler->handle($contactForm)) {

            return $responder(true, $contactForm, $gallery, $pictures);
        }
        
            return $responder(false, $contactForm, $gallery, $pictures);
    }
}
