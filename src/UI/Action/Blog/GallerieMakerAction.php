<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 14/05/2018
 * Time: 10:02
 */

namespace App\UI\Action\Blog;


use App\Domain\Models\Interfaces\GalleryMakerInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Action\Blog\Interfaces\GallerieMakerActionInterface;
use App\UI\Responder\Interfaces\GallerieMakerResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class GallerieMakerAction
 *
 * @Route(
 *     name="adminGallerieMaker",
 *      path="/admin/article/create/{slugGallery}/{slugArticle}",
 *     methods={"GET"}
 * )
 *
 */
final class GallerieMakerAction implements GallerieMakerActionInterface
{
    /**
     * @var GallerieMakerResponderInterface
     */
    private $responder;

    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

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
    private $authorization;

    /**
     * GallerieMakerAction constructor.
     *
     * @param GallerieMakerResponderInterface $responder
     * @param PictureRepositoryInterface $pictureRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param AuthorizationCheckerInterface $authorization
     */
    public function __construct(
        GallerieMakerResponderInterface $responder,
        PictureRepositoryInterface $pictureRepository,
        GalleryRepositoryInterface $galleryRepository,
        ArticleRepositoryInterface $articleRepository,
        AuthorizationCheckerInterface $authorization
    ) {
        $this->responder = $responder;
        $this->pictureRepository = $pictureRepository;
        $this->galleryRepository = $galleryRepository;
        $this->articleRepository = $articleRepository;
        $this->authorization = $authorization;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if ($this->authorization->isGranted('ROLE_ADMIN')) {
            $responder = $this->responder;

            $gallery = $this->galleryRepository->getOne($request->attributes->get('slugGallery'));

            $pictures = $this->pictureRepository->getAllByGallery($gallery);

            return $responder(false, $gallery, $pictures);
        }
    }
}
