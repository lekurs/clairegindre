<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 10:26
 */

namespace App\UI\Action\Blog;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Action\Blog\Interfaces\DeleteArticleActionInterface;
use App\UI\Responder\Interfaces\DeleteArticleResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteArticleAction
 *
 * @Route(
 *     name="adminDeleteArticle",
 *     path="admin/article/delete/{slug}",
 *     methods={"GET", "POST"}
 * )
 *
 */
class DeleteArticleAction implements DeleteArticleActionInterface
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * DeleteArticleAction constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param GalleryRepositoryInterface $galleryRepository
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        GalleryRepositoryInterface $galleryRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * @param Request $request
     * @param DeleteArticleResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteArticleResponderInterface $responder)
    {
        $article = $this->articleRepository->getOne($request->get('slug'));

        $gallery = $this->galleryRepository->findArticle($article->getId());

        $this->galleryRepository->removeArticle($article, $gallery);

        return $responder();
    }
}
