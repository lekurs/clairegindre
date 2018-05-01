<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 17:27
 */

namespace App\UI\Action\Front;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\DTO\UserLoginDTO;
use App\Domain\Form\LoginType;
use App\Domain\Form\Type\ContactType;
use App\Domain\Form\Type\CustomerLoginType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Models\Gallery;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Front\Interfaces\GalleriesCustomersActionInterface;
use App\UI\Responder\Interfaces\GalleriesCustomersResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GalleriesCustomersAction
 *
 * @Route(
 *     name="galleriesCustomers",
 *     path="galleries"
 * )
 *
 * @package App\UI\Action\Front
 */
class GalleriesCustomersAction implements GalleriesCustomersActionInterface
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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var InstagramLib
     */
    private $insta;

    /**
     * GalleriesCustomersAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param GalleryBuilderInterface $galleryBuilder
     * @param FormFactoryInterface $formFactory
     * @param UserRepositoryInterface $userRepository
     * @param InstagramLib $insta
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        GalleryBuilderInterface $galleryBuilder,
        FormFactoryInterface $formFactory,
        UserRepositoryInterface $userRepository,
        InstagramLib $insta
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->galleryBuilder = $galleryBuilder;
        $this->formFactory = $formFactory;
        $this->userRepository = $userRepository;
        $this->insta = $insta;
    }


    public function __invoke(Request $request, GalleriesCustomersResponderInterface $responder)
    {
        $galleries = $this->galleryRepository->getAllWithPictures();

        $contact = $this->formFactory->create(ContactType::class)->handleRequest($request);

        $customerLoginType = $this->formFactory->create(LoginType::class)->handleRequest($request);

        if($contact->isSubmitted() && $contact->isValid()) {

            return $responder(false, $contact, $customerLoginType, $galleries, $this->insta->show());
        }

        return $responder(false, $contact, $customerLoginType, $galleries, $this->insta->show());
    }

}