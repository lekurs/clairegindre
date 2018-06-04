<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 21:39
 */

namespace App\UI\Form\FormHandler;


use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

class ContactTypeHandler implements ContactTypeHandlerInterface
{
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
     * @param \Swift_Mailer $swiftMailer
     * @param Environment $twig
     */
    public function __construct(\Swift_Mailer $swiftMailer, Environment $twig)
    {
        $this->swiftMailer = $swiftMailer;
        $this->twig = $twig;
    }


    public function handle(FormInterface $form)
    {
        if($form->isSubmitted() && $form->isValid()) {

            $message = (new \Swift_Message)
                ->setSubject('Prise de contact')
                ->setFrom($form->getData()->email)
                ->setTo('lekurs@gmail.com')
                ->setBody($this->twig->render('mails/customerMail.html.twig', [
                    'DTO' => $form->getData()
                ]
            ),'text/html');

            $this->swiftMailer->send($message);

            return true;
        }
        return false;
    }
}
