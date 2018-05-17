<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 00:17
 */

namespace App\UI\Form\FormHandler;

use App\Domain\Builder\Interfaces\CommentBuilderInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddCommentOnArticleTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddCommentOnOnArticleTypeHandler implements AddCommentOnArticleTypeHandlerInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var CommentBuilderInterface
     */
    private $commentBuilder;

    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * AddCommentOnOnArticleTypeHandler constructor.
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param TokenStorageInterface $tokenStorage
     * @param CommentBuilderInterface $commentBuilder
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(ValidatorInterface $validator, SessionInterface $session, TokenStorageInterface $tokenStorage, CommentBuilderInterface $commentBuilder, CommentRepositoryInterface $commentRepository)
    {
        $this->validator = $validator;
        $this->session = $session;
        $this->tokenStorage = $tokenStorage;
        $this->commentBuilder = $commentBuilder;
        $this->commentRepository = $commentRepository;
    }


    public function handle(FormInterface $form, $article): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

//            dump($form->getData(),$article, $this->tokenStorage->getToken()->getUser());

            $this->commentBuilder->create(
                                                                                $form->getData()->content,
                                                                                $article,
                                                                                $form->getData()->email ?? null,
                                                                                $form->getData()->lastName ?? null,
                                                                                $form->getData()->author ?? null

                                                                            );

            $this->commentRepository->save($this->commentBuilder->getComment());

            return true;
        }
        return false;
    }
}
