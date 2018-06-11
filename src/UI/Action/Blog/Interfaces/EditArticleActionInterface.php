<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 10/05/2018
 * Time: 18:10
 */

namespace App\UI\Action\Blog\Interfaces;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\EditArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\EditArticleResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface EditArticleActionInterface
{
    /**
     * EditArticleAction constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param EditArticleTypeHandlerInterface $editArticleTypeHandler
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        EditArticleTypeHandlerInterface $editArticleTypeHandler,
        AuthorizationCheckerInterface $authorizationChecker,
        FormFactoryInterface $formFactory
    );

    /**
     * @param Request $request
     * @param EditArticleResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, EditArticleResponderInterface $responder);
}
