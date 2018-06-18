<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 17:27
 */

namespace App\UI\Action\Front\Interfaces;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Interfaces\GalleriesCustomersResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface GalleriesCustomersActionInterface
{
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
    );

    /**
     * @param Request $request
     * @param GalleriesCustomersResponderInterface $responder
     * @param int $page
     * @return mixed
     */
    public function __invoke(Request $request, GalleriesCustomersResponderInterface $responder, int $page);
}
