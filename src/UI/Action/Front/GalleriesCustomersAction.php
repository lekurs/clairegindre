<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 17:27
 */

namespace App\UI\Action\Front;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Form\Type\LoginType;
use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Front\Interfaces\GalleriesCustomersActionInterface;
use App\UI\Responder\Interfaces\GalleriesCustomersResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GalleriesCustomersAction
 *
 * @Route(
 *     name="galleriesCustomers",
 *     path="galleries/{page}",
 *     defaults={"page"=1},
 * )
 *
 * @package App\UI\Action\Front
 */
final class GalleriesCustomersAction implements GalleriesCustomersActionInterface
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
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * GalleriesCustomersAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param GalleryBuilderInterface $galleryBuilder
     * @param FormFactoryInterface $formFactory
     * @param UserRepositoryInterface $userRepository
     * @param InstagramLib $insta
     * @param ReviewsRepositoryInterface $reviewsRepository
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        GalleryBuilderInterface $galleryBuilder,
        FormFactoryInterface $formFactory,
        UserRepositoryInterface $userRepository,
        InstagramLib $insta,
        ReviewsRepositoryInterface $reviewsRepository
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->galleryBuilder = $galleryBuilder;
        $this->formFactory = $formFactory;
        $this->userRepository = $userRepository;
        $this->insta = $insta;
        $this->reviewsRepository = $reviewsRepository;
    }

    /**
     * @param Request $request
     * @param GalleriesCustomersResponderInterface $responder
     * @param int $page
     * @return mixed
     */
    public function __invoke(Request $request, GalleriesCustomersResponderInterface $responder, int $page)
    {
        $galleries = $this->galleryRepository->getAllWithPaginator($page, 15);

        $reviews = $this->reviewsRepository->getAllOnline();

        $pagination = [
           'page' => $page,
           'nbPages' => ceil(count($galleries) / 15)
        ];

        $contact = $this->formFactory->create(ContactType::class)->handleRequest($request);

        $customerLoginType = $this->formFactory->create(LoginType::class)->handleRequest($request);

        if($contact->isSubmitted() && $contact->isValid()) {

            return $responder(false, $contact, $customerLoginType, $galleries, $this->insta->show(), $reviews, $pagination);
        }

        return $responder(false, $contact, $customerLoginType, $galleries, $this->insta->show(), $reviews, $pagination);
    }
}
