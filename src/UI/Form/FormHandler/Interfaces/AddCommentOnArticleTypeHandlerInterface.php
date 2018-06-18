<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 00:17
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\CommentBuilderInterface;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddCommentOnArticleTypeHandlerInterface
{
    /**
     * AddCommentOnArticleTypeHandlerInterface constructor.
     *
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param TokenStorageInterface $tokenStorage
     * @param CommentBuilderInterface $commentBuilder
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        ValidatorInterface $validator,
        SessionInterface $session,
        TokenStorageInterface $tokenStorage,
        CommentBuilderInterface $commentBuilder,
        CommentRepositoryInterface $commentRepository
    );

    /**
     * @param FormInterface $form
     * @param $article
     * @return bool
     */
    public function handle(FormInterface $form, $article): bool;
}
