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
use Twig\Environment;

class ContactTypeHandler implements ContactTypeHandlerInterface
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
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * @var SlugHelperInterface
     */
    private $slugHelper;

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
     * @param \Swift_Mailer $swiftMailer
     * @param SlugHelperInterface $slugHelper
     * @param Environment $twig
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        UserRepositoryInterface $userRepository,
        MailerHelper $mailerHelper,
        \Swift_Mailer $swiftMailer,
        SlugHelperInterface $slugHelper,
        Environment $twig
    ) {
        $this->mailRepository = $mailRepository;
        $this->userRepository = $userRepository;
        $this->mailerHelper = $mailerHelper;
        $this->swiftMailer = $swiftMailer;
        $this->slugHelper = $slugHelper;
        $this->twig = $twig;
    }

    public function handle(FormInterface $form)
    {
        if($form->isSubmitted() && $form->isValid()) {

            dump($form->getData());
            dump($form->getData()->event->toArray());
            foreach ($form->getData()->event->toArray() as $event) {
                dump($event->getName());
            }
//            die;
            $user = $this->userRepository->getAdmin('contact@clairegindre.com');

//            dump($event->getName());
//            dump($user);
//            die;

//
            $mail = new Mail(
                $form->getData()->email,
                $user->getEmail(),
//                'renseignements - ' . $form->getData()->email . ' - ' . $form->getData()->event->toArray()->getBenefit()->getName(),
                'renseignements - ' . $form->getData()->name . ' - ' . $form->getData()->firstname,
                $form->getData()->details,
                false,
                $this->slugHelper->replace('renseignements - ' . $form->getData()->email)
            );
//

//
            dump($mail);

            $this->mailRepository->save($mail);
            die;

            //Send Email
            $this->mailerHelper->sendEmail('Prise de contact', $user->getEmail(),  $form->getData()->email);

            //Send confirmation to customer
            $this->mailerHelper->sendConfirmation('Claire GINDRE - Merci pour votre demande : ' . $form->getData()->name . ' - ' . $form->getData()->firstname, $form->getData()->email, $user->getEmail());

            return true;
        }
        return false;
    }
}
