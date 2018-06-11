<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 19:21
 */

namespace App\UI\Action\Admin;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\UI\Action\Admin\Interfaces\UpdateOnlineArticleAjaxActionInterface;
use App\UI\Responder\Admin\Interfaces\UpdateOnlineArticleAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateOnlineArticleAjaxAction
 *
 * @Route(
 *     name="adminUpdateOnlineArticle",
 *     path="admin/article/update/online",
 *     methods={"POST"}
 * )
 *
 */
final class UpdateOnlineArticleAjaxAction implements UpdateOnlineArticleAjaxActionInterface
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * UpdateOnlineArticleAjaxAction constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param Request $request
     * @param UpdateOnlineArticleAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UpdateOnlineArticleAjaxResponderInterface $responder)
    {
        $online = $this->articleRepository->getOneById($request->request->get('id'));

        $this->articleRepository->updateOnline($online);

        return $responder();
    }
}
