<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 21:39
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Models\Mail;
use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\SlugHelperInterface;
use App\Services\MailerHelper;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

final class ContactTypeHandler implements ContactTypeHandlerInterface
{
    /**
     * @var MailRepositoryInterface
     */
    private $mailRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var MailerHelper
     */
    private $mailerHelper;

    /**
     * @var SlugHelperInterface
     */
    private $slugHelper;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * ContactTypeHandler constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param UserRepositoryInterface $userRepository
     * @param MailerHelper $mailerHelper
     * @param SlugHelperInterface $slugHelper
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param Environment $twig
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        UserRepositoryInterface $userRepository,
        MailerHelper $mailerHelper,
        SlugHelperInterface $slugHelper,
        ValidatorInterface $validator,
        SessionInterface $session,
        Environment $twig
    ) {
        $this->mailRepository = $mailRepository;
        $this->userRepository = $userRepository;
        $this->mailerHelper = $mailerHelper;
        $this->slugHelper = $slugHelper;
        $this->validator = $validator;
        $this->session = $session;
        $this->twig = $twig;
    }

    /**
     * @param FormInterface $form
     * @return bool
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(FormInterface $form):bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $user = $this->userRepository->getAdmin('contact@clairegindre.com');

            dump($form->getData());
            die;
//
            $mail = new Mail(
                $form->getData()->email,
                $user->getEmail(),
                'renseignements - ' . $form->getData()->name . ' - ' . $form->getData()->firstname,
                $form->getData()->details,
                $form->getData()->phone,
                false,
                $this->slugHelper->replace('renseignements - ' . $form->getData()->email)
            );

            $this->validator->validate($mail, [], [
                'contact_creation'
            ]);

            //insert mail
            $this->mailRepository->save($mail);

            //Send Email
            $this->mailerHelper->sendEmail('Prise de contact', $user->getEmail(),  $form->getData()->email);

            //Send confirmation to customer
            $this->mailerHelper->sendConfirmation('Claire GINDRE - Merci pour votre demande : ' . $form->getData()->name . ' - ' . $form->getData()->firstname, $form->getData()->email, $user->getEmail());

            $this->session->getFlashBag()->add('success', 'Votre demande de renseignements est validée');

            return true;
        }
        return false;
    }
}
