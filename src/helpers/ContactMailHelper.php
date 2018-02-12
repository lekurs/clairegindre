<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 09/02/2018
 * Time: 00:08
 */

namespace App\helpers;


use Symfony\Component\HttpFoundation\Request;

class ContactMailHelper
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Request $request)
    {
        $name = $request->get('contact_form[email]');

        $message = (new \Swift_Message('Votre demande de renseignements à été prise en compte'))
            ->setFrom('contact@clairegindre.com')
            ->setTo($request->get('contact_form[email]'))
            ->setBody(
                $this->renderView(
                    'mails/customerMail.html.twig'
                     ,array('name' => $name)
                ),
                'text/html'
            );

        return $this->mailer->send($message);
    }
}