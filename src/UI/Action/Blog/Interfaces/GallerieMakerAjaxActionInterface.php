<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 13:56
 */

namespace App\UI\Action\Blog\Interfaces;


use App\Domain\Builder\Interfaces\GalleryMakerBuilderInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryMakerRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Responder\Interfaces\GallerieMakerAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface GallerieMakerAjaxActionInterface
{
    /**
     * GallerieMakerAjaxActionInterface constructor.
     *
     * @param GalleryMakerBuilderInterface $galleryPageBuilder
     * @param GalleryMakerRepositoryInterface $galleryPageRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param SessionInterface $session
     */
    public function __construct(
        GalleryMakerBuilderInterface $galleryPageBuilder,
        GalleryMakerRepositoryInterface $galleryPageRepository,
        GalleryRepositoryInterface $galleryRepository,
        ArticleRepositoryInterface $articleRepository,
        AuthorizationCheckerInterface $authorizationChecker,
        SessionInterface $session
    );

    /**
     * @param Request $request
     * @param GallerieMakerAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, GallerieMakerAjaxResponderInterface $responder);
}
