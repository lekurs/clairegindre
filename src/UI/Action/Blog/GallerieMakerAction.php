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
use App\UI\Responder\Interfaces\GallerieMakerResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
class GallerieMakerAction implements GalleryMakerInterface
{
    /**
     * @var GallerieMakerResponderInterface
     */
    private $responder;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * GallerieMakerAction constructor.
     * @param GallerieMakerResponderInterface $responder
     * @param GalleryRepositoryInterface $galleryRepository
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(GallerieMakerResponderInterface $responder, GalleryRepositoryInterface $galleryRepository, ArticleRepositoryInterface $articleRepository)
    {
        $this->responder = $responder;
        $this->galleryRepository = $galleryRepository;
        $this->articleRepository = $articleRepository;
    }


    public function __invoke(Request $request)
    {
        $responder = $this->responder;

        $gallery = $this->galleryRepository->getOne($request->attributes->get('slugGallery'));

        return $responder(false, $gallery);
    }
}