<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 19:21
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\UI\Responder\Admin\Interfaces\UpdateOnlineArticleAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface UpdateOnlineArticleAjaxActionInterface
{
    /**
     * UpdateOnlineArticleAjaxActionInterface constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository);

    /**
     * @param Request $request
     * @param UpdateOnlineArticleAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UpdateOnlineArticleAjaxResponderInterface $responder);
}
