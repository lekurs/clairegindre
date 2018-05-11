<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 18:45
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\ArticleBuilderInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Services\StringReplaceUrlHelper;
use App\UI\Form\FormHandler\Interfaces\EditArticleTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EditArticleTypeHandler implements EditArticleTypeHandlerInterface
{
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
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var StringReplaceUrlHelper
     */
    private $stringReplaceHelper;

    /**
     * EditArticleTypeHandler constructor.
     *
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ArticleBuilderInterface $articleBuilder
     * @param ArticleRepositoryInterface $articleRepository
     * @param TokenStorageInterface $tokenStorage
     * @param StringReplaceUrlHelper $stringReplaceHelper
     */
    public function __construct(
        SessionInterface $session,
        ValidatorInterface $validator,
        ArticleBuilderInterface $articleBuilder,
        ArticleRepositoryInterface $articleRepository,
        TokenStorageInterface $tokenStorage,
        StringReplaceUrlHelper $stringReplaceHelper
    ) {
        $this->session = $session;
        $this->validator = $validator;
        $this->articleBuilder = $articleBuilder;
        $this->articleRepository = $articleRepository;
        $this->tokenStorage = $tokenStorage;
        $this->stringReplaceHelper = $stringReplaceHelper;
    }


    /**
     * @param FormInterface $form
     * @param $article
     * @return bool
     */
    public function handle(FormInterface $form, $article): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $articleEdit = $this->articleBuilder->create(
                                                                    $form->getData()->title,
                                                                    $form->getData()->content,
                                                                    $article->getCreationDate(),
                                                                    $form->getData()->online,
                                                                    $this->tokenStorage->getToken()->getUser(),
                                                                    $form->getData()->personnalButton,
                                                                    $this->stringReplaceHelper->replace($form->getData()->title),
                                                                    $article->getGallery(),
                                                                    $form->getData()->prestation
            );

            $this->validator->validate($articleEdit, [], [
                'article_edit'
            ]);

            dump($this->articleBuilder->getArticle());
//            die();

            $this->articleRepository->update();

            die();

            $this->session->getFlashBag()->add('success', 'L\'article à été modifié');

            return true;
        }
        return false;
    }
}
