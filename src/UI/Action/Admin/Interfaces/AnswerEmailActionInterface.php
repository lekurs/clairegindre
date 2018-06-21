<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 17:16
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AnswerMailTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\MarkMailAsReadTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AnswerMailResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface AnswerEmailActionInterface
{
    /**
     * AnswerEmailActionInterface constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param FormFactoryInterface $formFactory
     * @param AnswerMailTypeHandlerInterface $answerMailHandler
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param AuthenticationErrorsResponder $errorsResponder
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        FormFactoryInterface $formFactory,
        AnswerMailTypeHandlerInterface $answerMailHandler,
        AuthorizationCheckerInterface $authorizationChecker,
        AuthenticationErrorsResponder $errorsResponder
    );

    /**
     * @param Request $request
     * @param AnswerMailResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AnswerMailResponderInterface $responder);
}
