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
use App\Services\MailerAdminHelper;
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
     * @var MailerAdminHelper
     */
    private $mailerAdmin;

    /**
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * ContactTypeHandler constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param UserRepositoryInterface $userRepository
     * @param MailerAdminHelper $mailerAdmin
     * @param \Swift_Mailer $swiftMailer
     * @param Environment $twig
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        UserRepositoryInterface $userRepository,
        MailerAdminHelper $mailerAdmin,
        \Swift_Mailer $swiftMailer,
        Environment $twig
    ) {
        $this->mailRepository = $mailRepository;
        $this->userRepository = $userRepository;
        $this->mailerAdmin = $mailerAdmin;
        $this->swiftMailer = $swiftMailer;
        $this->twig = $twig;
    }

    public function handle(FormInterface $form)
    {
        if($form->isSubmitted() && $form->isValid()) {
            dump($form->getData()->event->toArray());
            foreach ($form->getData()->event->toArray() as $event) {
                dump($event->getName());
            }
            die;
            $user = $this->userRepository->getAdmin('contact@clairegindre.com');
            $mail = new Mail(
                $form->getData()->email,
                $user,
                'renseignements - ' . $form->getData()->email . ' - ' . $form->getData()->event->toArray()->getBenefit()->getName(),
                $form->getData()->content,
                false,
                'renseignements - ' . $form->getData()->email . ' - ' . $form->getData()->benefit
            );

            dump($mail);
            die;

            $message = (new \Swift_Message)
                ->setSubject('Prise de contact')
                ->setFrom($form->getData()->email)
                ->setTo('lekurs@gmail.com') //Changer pour UserInterface
                ->setBody($this->twig->render('mails/customerMail.html.twig', [
                    'DTO' => $form->getData()
                ]
            ),'text/html');

            $this->swiftMailer->send($message);

//            $user = $this->userRepository->getAdmin('contact@clairegindre.com');

//            $mail = new Mail(
//                                            $form->getData()->email,
//                                            $user,
//                                            'renseignements - ' . $form->getData()->email . ' - ' . $form->getData()->benefit,
//                                            $form->getData()->content,
//                                            false,
//                                            'renseignements - ' . $form->getData()->email . ' - ' . $form->getData()->benefit
//                                         );

            return true;
        }
        return false;
    }
}
