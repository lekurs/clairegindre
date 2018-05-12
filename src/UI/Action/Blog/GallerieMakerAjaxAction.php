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
use App\UI\Action\Blog\Interfaces\GallerieMakerAjaxActionInterface;
use App\UI\Responder\Interfaces\GallerieMakerAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * GallerieMakerAjaxAction constructor.
     * @param GalleryMakerBuilderInterface $galleryPageBuilder
     * @param GalleryPageRepositoryInterface $galleryPageRepository
     */
    public function __construct(GalleryMakerBuilderInterface $galleryPageBuilder, GalleryPageRepositoryInterface $galleryPageRepository)
    {
        $this->galleryPageBuilder = $galleryPageBuilder;
        $this->galleryPageRepository = $galleryPageRepository;
    }


    public function __invoke(Request $request, GallerieMakerAjaxResponderInterface $responder)
    {
        $builder = $this->galleryPageBuilder->create();
        dump($request->request);
        die();
        return $responder();
    }
}
