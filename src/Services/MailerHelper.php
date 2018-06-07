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
    public function __construct(string $mailerAdminEmail, \Swift_Mailer $swiftMailer, Environment $twig)
    {
        $this->mailerAdminEmail = $mailerAdminEmail;
        $this->swiftMailer = $swiftMailer;
        $this->twig = $twig;
    }

    /**
     * @param $subject
     * @param $to
     * @param $from
     * @return mixed|void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmail($subject, $to, $from)
    {
        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($this->mailerAdminEmail)
            ->setFrom($from)
            ->setBody($this->twig->render('mails/customerMail.html.twig'), 'text/html');

        $this->swiftMailer->send($message);
    }

    /**
     * @param $subject
     * @param $to
     * @param $from
     * @return mixed|void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendConfirmation($subject, $to, $from)
    {
        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($to)
            ->setFrom($from)
            ->setBody($this->twig->render('mails/confirmation_mail.html.twig'), 'text/html');

        $this->swiftMailer->send($message);
    }

    /**
     * @param $subject
     * @param $to
     * @param $from
     * @param $content
     * @return mixed|void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendResponse($subject, $to, $from, $content)
    {
        $message = (new \Swift_Message());

        $logo = $message->embed(\Swift_Image::fromPath('images/interface/logos/logo-color.png', 'image/png'));

        $message->setSubject('[NE PAS REPONDRE]' . $subject)
            ->setTo($to)
            ->setFrom($from)
            ->setCc($from)
            ->setBody($this->twig->render('mails/response_mail.html.twig', ['content' => $content, 'attachment' => $logo]), 'text/html');

        $this->swiftMailer->send($message);
    }

    public function getAdmin()
    {
        dump($this->mailerAdminEmail);
    }
}
