<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 13:56
 */

namespace App\UI\Action\Blog;


use App\Domain\Builder\Interfaces\GalleryMakerBuilderInterface;
use App\Domain\Repository\Interfaces\GalleryPageRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Action\Blog\Interfaces\GallerieMakerAjaxActionInterface;
use App\UI\Responder\Interfaces\GallerieMakerAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class GallerieMakerAjaxAction
 *
 * @Route(
 *     name="adminGallerieMaker",
 *     path="admin/blog/create/article/{slugGallery}",
 *     methods={"POST"}
 * )
 *
 */
class GallerieMakerAjaxAction implements GallerieMakerAjaxActionInterface
{
    /**
     * @var GalleryMakerBuilderInterface
     */
    private $galleryPageBuilder;

    /**
     * @var GalleryPageRepositoryInterface
     */
    private $galleryPageRepository;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * GallerieMakerAjaxAction constructor.
     * @param GalleryMakerBuilderInterface $galleryPageBuilder
     * @param GalleryPageRepositoryInterface $galleryPageRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param SessionInterface $session
     */
    public function __construct(GalleryMakerBuilderInterface $galleryPageBuilder, GalleryPageRepositoryInterface $galleryPageRepository, GalleryRepositoryInterface $galleryRepository, AuthorizationCheckerInterface $authorizationChecker, SessionInterface $session)
    {
        $this->galleryPageBuilder = $galleryPageBuilder;
        $this->galleryPageRepository = $galleryPageRepository;
        $this->galleryRepository = $galleryRepository;
        $this->authorizationChecker = $authorizationChecker;
        $this->session = $session;
    }


    public function __invoke(Request $request, GallerieMakerAjaxResponderInterface $responder)
    {
        dump($this->session->get('gallery')->id);

        $article = $this->galleryRepository->find($this->session->get('gallery')->id);
        dump($article);
        die;
        $builder = $this->galleryPageBuilder->create();
        dump($request->request);
        die();
        return $responder();
    }
}
