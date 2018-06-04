<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 20:42
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\Services\SlugHelper;
use App\UI\Form\FormHandler\Interfaces\AnswerMailTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AnswerMailTypeHandler implements AnswerMailTypeHandlerInterface
{
    /**
     * @var MailRepositoryInterface
     */
    private $mailRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var SlugHelper
     */
    private $slugHelper;

    /**
     * AnswerMailTypeHandler constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param \Swift_Mailer $mailer
     * @param SlugHelper $slugHelper
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        \Swift_Mailer $mailer,
        SlugHelper $slugHelper
    ) {
        $this->mailRepository = $mailRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->mailer = $mailer;
        $this->slugHelper = $slugHelper;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            //Verif du message

            dump($form->getData());
            die;

            //Envoie de l'email

            $message = (new \Swift_Message)
                ->setSubject($form->getData()->subject);

            $this->mailer->send($message);

            return true;
        }

        return false;
    }
}