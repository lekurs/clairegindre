<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 20:42
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Models\Mail;
use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\Services\Interfaces\MailerHelperInterface;
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
     * @var MailerHelperInterface
     */
    private $mailerHelper;

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
     * @param MailerHelperInterface $mailerHelper
     * @param SlugHelper $slugHelper
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        MailerHelperInterface $mailerHelper,
        SlugHelper $slugHelper
    ) {
        $this->mailRepository = $mailRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->mailerHelper = $mailerHelper;
        $this->slugHelper = $slugHelper;
    }

    /**
     * @param FormInterface $form
     * @param $mail
     * @return bool
     */
    public function handle(FormInterface $form, $mail): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $this->session->set('to', $mail->getToEmail());

            //Insert the response
            $emailResponse = new Mail($mail->getFromSender(), $mail->getToEmail(), $form->getData()->subject, $form->getData()->content, true, $mail->getSlug(), $mail);

            $this->validator->validate($emailResponse, [], ['answer_mail']);

            $this->mailRepository->save($emailResponse);

            //The initial Mail have been treated
            $this->mailRepository->update($mail);


            //Send Message
            $this->mailerHelper->sendResponse($form->getData()->subject, $mail->getToEmail(), $mail->getFromSender(), $form->getData()->content);
//            $this->mailerHelper->sendResponse($form->getData()->subject, 'lekurs@gmail.com', 'lekurs@gmail.com', $form->getData()->content);

            $this->session->getFlashBag()->add('success', 'La réponse à bien été envoyée');

            return true;
        }

        return false;
    }
}
