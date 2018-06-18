<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 17:16
 */

namespace App\UI\Action\Admin;


use App\Domain\DTO\AnswerMailDTO;
use App\Domain\Form\Type\AnswerEmailType;
use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\UI\Action\Admin\Interfaces\AnswerEmailActionInterface;
use App\UI\Form\FormHandler\Interfaces\AnswerMailTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AnswerMailResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * AnswerEmailAction constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param FormFactoryInterface $formFactory
     * @param AnswerMailTypeHandlerInterface $answerMailHandler
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        FormFactoryInterface $formFactory,
        AnswerMailTypeHandlerInterface $answerMailHandler
    ) {
        $this->mailRepository = $mailRepository;
        $this->formFactory = $formFactory;
        $this->answerMailHandler = $answerMailHandler;
    }

    /**
     * @param Request $request
     * @param AnswerMailResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AnswerMailResponderInterface $responder)
    {
        $mail = $this->mailRepository->getOneBySlug($request->attributes->get('slug'));

        $form = $this->formFactory->create(AnswerEmailType::class)->handleRequest($request);

        if ($this->answerMailHandler->handle($form, $mail)) {

            return $responder(true, $form, $mail);
        }

        return $responder(false, $form, $mail);
    }
}
