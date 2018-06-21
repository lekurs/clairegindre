<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 17:16
 */

namespace App\UI\Action\Admin;


use App\Domain\Form\Type\AnswerEmailType;
use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\UI\Action\Admin\Interfaces\AnswerEmailActionInterface;
use App\UI\Form\FormHandler\Interfaces\AnswerMailTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AnswerMailResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class AnswerEmailAction
 *
 * @Route(
 *     name="admin_answer_mail",
 *     path="admin/email/{slug}",
 *     methods={"GET", "POST"}
 * )
 *
 */
final class AnswerEmailAction implements AnswerEmailActionInterface
{
    /**
     * @var MailRepositoryInterface
     */
    private $mailRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AnswerMailTypeHandlerInterface
     */
    private $answerMailHandler;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var AuthenticationErrorsResponder
     */
    private $authorizationErrorResponder;


    /**
     * AnswerEmailAction constructor.
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
    ) {
        $this->mailRepository = $mailRepository;
        $this->formFactory = $formFactory;
        $this->answerMailHandler = $answerMailHandler;
        $this->authorizationChecker = $authorizationChecker;
        $this->authorizationErrorResponder = $errorsResponder;
    }

    /**
     * @param Request $request
     * @param AnswerMailResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AnswerMailResponderInterface $responder)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $mail = $this->mailRepository->getOneBySlug($request->attributes->get('slug'));

            $form = $this->formFactory->create(AnswerEmailType::class)->handleRequest($request);

            if ($this->answerMailHandler->handle($form, $mail)) {

                return $responder(true, $form, $mail);
            }

            return $responder(false, $form, $mail);
        }
        else {
            $error = $this->authorizationErrorResponder;

            return $error();
        }
    }
}
