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
use App\UI\Form\FormHandler\Interfaces\AddCommentArticleUserNotConnectedTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddCommentArticleUserNotConnectedTypeHandler implements AddCommentArticleUserNotConnectedTypeHandlerInterface
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
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * AddCommentArticleUserNotConnectedTypeHandler constructor.
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param CommentBuilderInterface $commentBuilder
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(ValidatorInterface $validator, SessionInterface $session, CommentBuilderInterface $commentBuilder, CommentRepositoryInterface $commentRepository)
    {
        $this->validator = $validator;
        $this->session = $session;
        $this->commentBuilder = $commentBuilder;
        $this->commentRepository = $commentRepository;
    }


    public function handle(FormInterface $form, $article): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            dump($form->getData(),$article);
            die();

            $comment = $this->commentBuilder->create(
                                                                                null,
                                                                                $form->getData()->email,
                                                                                $form->getData()->lastName,
                                                                                $form->getData()->content,
                                                                                $article
//                                                                                new \DateTime(),
                                                                            );

            return true;
        }
        return false;
    }
}
