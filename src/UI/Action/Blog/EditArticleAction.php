<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 10/05/2018
 * Time: 18:10
 */

namespace App\UI\Action\Blog;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\UI\Action\Blog\Interfaces\EditArticleActionInterface;
use App\UI\Responder\Interfaces\EditArticleResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class EditArticleAction
 *
 * @Route(
 *     name="adminEditArticle",
 *     path="admin/article/edit/{articleTitle}"
 * )
 *
 */
class EditArticleAction implements EditArticleActionInterface
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * EditArticleAction constructor.
     * @param ArticleRepositoryInterface $articleRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ArticleRepositoryInterface $articleRepository, AuthorizationCheckerInterface $authorizationChecker, TokenStorageInterface $tokenStorage)
    {
        $this->articleRepository = $articleRepository;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
    }

    public function __invoke(Request $request, EditArticleResponderInterface $responder)
    {
        if (!false === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {

        }

//        $article = $this->articleRepository->

        return $responder($article);
    }

}