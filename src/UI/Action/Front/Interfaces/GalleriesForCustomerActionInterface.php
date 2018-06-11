<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 15:02
 */

namespace App\UI\Action\Front\Interfaces;


use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Responder\Interfaces\GalleriesForCustomerResponderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface GalleriesForCustomerActionInterface
{
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
    );

    /**
     * @param GalleriesForCustomerResponderInterface $responder
     * @return mixed
     */
    public function __invoke(GalleriesForCustomerResponderInterface $responder);
}