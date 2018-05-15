<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 13:56
 */

namespace App\UI\Action\Blog;


use App\Domain\Builder\Interfaces\GalleryMakerBuilderInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryMakerRepositoryInterface;
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
 *     name="adminGallerieMakerPostAjax",
 *     path="admin/blog/create/article/{slugGallery}/{slugArticle}",
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
     * @var GalleryMakerRepositoryInterface
     */
    private $galleryPageRepository;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

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
     * @param GalleryMakerRepositoryInterface $galleryPageRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param SessionInterface $session
     */
    public function __construct(GalleryMakerBuilderInterface $galleryPageBuilder, GalleryMakerRepositoryInterface $galleryPageRepository, GalleryRepositoryInterface $galleryRepository, ArticleRepositoryInterface $articleRepository, AuthorizationCheckerInterface $authorizationChecker, SessionInterface $session)
    {
        $this->galleryPageBuilder = $galleryPageBuilder;
        $this->galleryPageRepository = $galleryPageRepository;
        $this->galleryRepository = $galleryRepository;
        $this->articleRepository = $articleRepository;
        $this->authorizationChecker = $authorizationChecker;
        $this->session = $session;
    }


    public function __invoke(Request $request, GallerieMakerAjaxResponderInterface $responder)
    {
//        $article = $this->articleRepository->getOne($request->get('slugArticle'));

        $gallery = $this->galleryRepository->getOne($request->attributes->get('slugGallery'));


        $pictures = $gallery->getPictures();

        foreach($request->request->get('line') as $key => $line) {
            foreach ($line as $imageKey => $image) {
                foreach ($pictures as $picture) {
                    if ($picture->getId() === $image) {
                        $this->galleryPageBuilder->create($gallery->getArticle(), $key, $imageKey, $image);
                        $this->galleryPageRepository->save($this->galleryPageBuilder->getGalleryBuilder(), $picture);
                    }
                }
            }
        }

        die;

//        $this->galleryPageRepository->save($this->galleryPageBuilder->getGalleryBuilder(), $image);

        return $responder();
    }
}
