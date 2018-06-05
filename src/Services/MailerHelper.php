<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 21:50
 */

namespace App\Services;


use App\Services\Interfaces\MailerHelperInterface;
use Twig\Environment;

final class MailerHelper implements MailerHelperInterface
{
    /**
     * @var string
     */
    private $mailerAdminEmail;

    /**
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * MailerHelper constructor.
     * @param string $mailerAdminEmail
     * @param \Swift_Mailer $swiftMailer
     * @param Environment $twig
     */
    public function __construct(\Swift_Mailer $swiftMailer, Environment $twig)
    {
//        $this->mailerAdminEmail = $mailerAdminEmail;
        $this->swiftMailer = $swiftMailer;
        $this->twig = $twig;
    }


    public function sendEmail($subject, $to, $from)
    {
        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($to)
            ->setFrom($from)
            ->setBody($this->twig->render('mails/customerMail.html.twig'), 'text/html');

        $this->swiftMailer->send($message);
    }

    public function sendConfirmation($subject, $to, $from)
    {
        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($to)
            ->setFrom($from)
            ->setBody($this->twig->render('mails/confirmation_mail.html.twig'), 'text/html');

        $this->swiftMailer->send($message);
    }

    public function sendResponse($subject, $to, $from, $content)
    {
        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($to)
            ->setFrom($from)
            ->setBody($this->twig->render('mails/response_mail.html.twig', ['content' => $content]), 'text/html');
//
//        dump($message);
//        die;

        $this->swiftMailer->send($message);
    }

    public function getAdmin()
    {
        dump($this->mailerAdminEmail);
    }
}
