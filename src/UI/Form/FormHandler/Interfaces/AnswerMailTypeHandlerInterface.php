<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 20:42
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\Services\SlugHelper;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AnswerMailTypeHandlerInterface
{
    /**
     * AnswerMailTypeHandlerInterface constructor.
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
    );

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}