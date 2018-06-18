<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 14/05/2018
 * Time: 10:03
 */

namespace App\UI\Action\Blog\Interfaces;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Responder\Interfaces\GallerieMakerResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface GallerieMakerActionInterface
{
    /**
     * GallerieMakerActionInterface constructor.
     *
     * @param GallerieMakerResponderInterface $responder
     * @param GalleryRepositoryInterface $galleryRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param AuthorizationCheckerInterface $authorization
     */
    public function __construct(
        GallerieMakerResponderInterface $responder,
        GalleryRepositoryInterface $galleryRepository,
        ArticleRepositoryInterface $articleRepository,
        AuthorizationCheckerInterface $authorization
    );

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request);
}
