<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 10/05/2018
 * Time: 18:10
 */

namespace App\UI\Action\Blog;


use App\Domain\DTO\EditArticleTypeDTO;
use App\Domain\Form\Type\EditArticleType;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\UI\Action\Blog\Interfaces\EditArticleActionInterface;
use App\UI\Form\FormHandler\Interfaces\EditArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\EditArticleResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class EditArticleAction
 *
 * @Route(
 *     name="adminEditArticle",
 *     path="admin/article/edit/{slug}"
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
     * @var EditArticleTypeHandlerInterface
     */
    private $editArticleTypeHandler;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

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
    ) {
        $this->articleRepository = $articleRepository;
        $this->editArticleTypeHandler = $editArticleTypeHandler;
        $this->authorizationChecker = $authorizationChecker;
        $this->formFactory = $formFactory;
    }


    public function __invoke(Request $request, EditArticleResponderInterface $responder)
    {
        if(false === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Merci de vous connecter comme Administrateur sur ce site !');
        }

        $article = $this->articleRepository->getOne($request->get('slug'));

        dump($article);

        $articleDTO = new EditArticleTypeDTO(
                                                                                    $article->getTitle(),
                                                                                    $article->getContent(),
                                                                                    $article->isOnline(),
                                                                                    $article->getPersonnalButton(),
                                                                                    $article->getPrestation(),
                                                                                    $article->getSlug()
            );

        $editArticleType = $this->formFactory->create(EditArticleType::class, $articleDTO)->handleRequest($request);

        if ($this->editArticleTypeHandler->handle($editArticleType, $article))
        {
            return $responder(true, null, $article);
        }

        return $responder(false, $editArticleType, $article);
    }
}
