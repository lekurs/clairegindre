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
use App\UI\Form\FormHandler\Interfaces\AddCommentArticleNotLoggedTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddCommentArticleNotLoggedTypeHandler implements AddCommentArticleNotLoggedTypeHandlerInterface
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
     * @var CommentBuilderInterface
     */
    private $commentBuilder;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * AddCommentArticleNotLoggedTypeHandler constructor.
     *
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param CommentBuilderInterface $commentBuilder
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(
        ValidatorInterface $validator,
        SessionInterface $session,
        CommentBuilderInterface $commentBuilder,
        ArticleRepositoryInterface $articleRepository
    ) {
        $this->validator = $validator;
        $this->session = $session;
        $this->commentBuilder = $commentBuilder;
        $this->articleRepository = $articleRepository;
    }

    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            dump('ok');

            return true;
        }
        return false;
    }
}
