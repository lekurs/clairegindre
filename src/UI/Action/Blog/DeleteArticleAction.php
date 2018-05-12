<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 10:26
 */

namespace App\UI\Action\Blog;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
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
     * DeleteArticleAction constructor.
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function __invoke(Request $request, DeleteArticleResponderInterface $responder)
    {
        $article = $this->articleRepository->getOne($request->get('slug'));
//        65dee3bb-49b3-45d1-9d49-157c36676a79
        dump($article);
//        die();

        $this->articleRepository->delete($article);

        return $responder();
    }
}