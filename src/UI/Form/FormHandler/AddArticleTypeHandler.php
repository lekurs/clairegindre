<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:19
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\ArticleBuilderInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddArticleTypeHandler implements AddArticleTypeHandlerInterface
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ArticleBuilderInterface
     */
    private $articleBuilder;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddArticleTypeHandler constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ArticleBuilderInterface $articleBuilder
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        ArticleBuilderInterface $articleBuilder,
        TokenStorageInterface $tokenStorage
    ) {
        $this->articleRepository = $articleRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->articleBuilder = $articleBuilder;
        $this->tokenStorage = $tokenStorage;
    }

    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $article = $this->articleBuilder->create(
                                                                                    $form->getData()->title,
                                                                                    $form->getData()->content,
                                                                                    new \DateTime(),
                                                                                    $form->getData()->online,
                                                                                    $this->tokenStorage->getToken()->getUser(),
                                                                                    $form->getData()->personnalButton,
                                                                                    $form->getData()->gallery,
                                                                                    $form->getData()->prestation
                                                                                );

            $this->validator->validate($article, [], [
                'article_creation'
            ]);

            $this->articleRepository->save($this->articleBuilder->getArticle());

            $this->session->getFlashBag()->add('success', 'Article bien ajouté');

            return true;
        }
        return false;
    }
}
