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
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

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
final class DeleteArticleAction implements DeleteArticleActionInterface
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
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    /**
     * DeleteArticleAction constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param AuthorizationCheckerInterface $authorization
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        GalleryRepositoryInterface $galleryRepository,
        AuthorizationCheckerInterface $authorization
    ) {
        $this->articleRepository = $articleRepository;
        $this->galleryRepository = $galleryRepository;
        $this->authorization = $authorization;
    }


    /**
     * @param Request $request
     * @param DeleteArticleResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteArticleResponderInterface $responder)
    {
        if ($this->authorization->isGranted('ROLE_ADMIN')) {

            $article = $this->articleRepository->getOne($request->get('slug'));

            $gallery = $this->galleryRepository->findArticle($article->getId());

            $this->galleryRepository->removeArticle($article, $gallery);

            return $responder();
        }
    }
}
