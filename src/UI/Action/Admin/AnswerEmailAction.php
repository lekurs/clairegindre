<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 17:16
 */

namespace App\UI\Action\Admin;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\UI\Action\Admin\Interfaces\AnswerEmailActionInterface;
use App\UI\Form\FormHandler\Interfaces\AnswerMailTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AnswerMailResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @param MailRepositoryInterface $mailRepository
     * @param FormFactoryInterface $formFactory
     * @param AnswerMailTypeHandlerInterface $answerMailHandler
     */
    public function __construct(MailRepositoryInterface $mailRepository, FormFactoryInterface $formFactory, AnswerMailTypeHandlerInterface $answerMailHandler)
    {
        $this->mailRepository = $mailRepository;
        $this->formFactory = $formFactory;
        $this->answerMailHandler = $answerMailHandler;
    }

    public function __invoke(Request $request, AnswerMailResponderInterface $responder)
    {
        return $responder();
    }
}
