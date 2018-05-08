<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 15:01
 */

namespace App\UI\Action\Front;


use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Action\Front\Interfaces\GalleriesForCustomerActionInterface;
use App\UI\Responder\Interfaces\GalleriesForCustomerResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class GalleriesForCustomerAction
 *
 * @Route(
 *     name="galleriesForCustomer",
 *     path="galleries/{user}/{id}"
 * )
 *
 */
class GalleriesForCustomerAction implements GalleriesForCustomerActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var InstagramLib
     */
    private $instagram;

    /**
     * GalleriesForCustomerAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param InstagramLib $instagram
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        InstagramLib $instagram
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
        $this->instagram = $instagram;
    }

    /**
     * @param GalleriesForCustomerResponderInterface $responder
     * @return mixed
     */
    public function __invoke(GalleriesForCustomerResponderInterface $responder)
    {
        $galleries = $this->galleryRepository->getGalleryByUser($this->tokenStorage->getToken()->getUser()->getId());

//        foreach($galleries as $gallery) {
//            dump($gallery->getUser()->getUsername(), $this->tokenStorage->getToken()->getUser()->getUsername());
//
//            if (false === $this->authorizationChecker->isGranted($gallery->getUser()->getUsername(), $this->tokenStorage->getToken()->getUser()->getUsername())) {
//                throw new AccessDeniedException('pas d\'accès');
//            }
//        }

        return $responder($galleries, $this->instagram->show());

    }
}
