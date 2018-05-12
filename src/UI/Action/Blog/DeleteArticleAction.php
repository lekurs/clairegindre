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
     * @param ArticleRepositoryInterface $articleRepository
     * @param GalleryRepositoryInterface $galleryRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository, GalleryRepositoryInterface $galleryRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->galleryRepository = $galleryRepository;
    }


    public function __invoke(Request $request, DeleteArticleResponderInterface $responder)
    {
        $article = $this->articleRepository->getOne($request->get('slug'));
//        65dee3bb-49b3-45d1-9d49-157c36676a79
        dump($article);

        $this->galleryRepository->removeArticle($article, $article->getGallery());

        return $responder();
    }
}