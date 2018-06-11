<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 18:45
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Services\SlugHelper;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface EditArticleTypeHandlerInterface
{
    /**
     * EditArticleTypeHandlerInterface constructor.
     *
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ArticleRepositoryInterface $articleRepository
     * @param TokenStorageInterface $tokenStorage
     * @param SlugHelper $stringReplaceHelper
     */
    public function __construct(
        SessionInterface $session,
        ValidatorInterface $validator,
        ArticleRepositoryInterface $articleRepository,
        TokenStorageInterface $tokenStorage,
        SlugHelper $stringReplaceHelper
    );

    /**
     * @param FormInterface $form
     * @param $article
     * @return bool
     */
    public function handle(FormInterface $form, $article): bool;
}
