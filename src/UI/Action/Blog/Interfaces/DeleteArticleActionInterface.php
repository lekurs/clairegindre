<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 10:26
 */

namespace App\UI\Action\Blog\Interfaces;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Responder\Interfaces\DeleteArticleResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface DeleteArticleActionInterface
{
    /**
     * DeleteArticleAction constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param AuthorizationCheckerInterface $authorization
     * @param SessionInterface $session
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        GalleryRepositoryInterface $galleryRepository,
        AuthorizationCheckerInterface $authorization,
        SessionInterface $session
    ) ;

    /**
     * @param Request $request
     * @param DeleteArticleResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteArticleResponderInterface $responder);
}
