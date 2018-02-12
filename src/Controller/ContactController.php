<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/02/2018
 * Time: 12:20
 */

namespace App\Controller;


use App\Form\ContactForm;
use App\helpers\ContactMailHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function post(Request $request)
    {
        $task = new ContactForm();
        $form = $this->createForm(ContactForm::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           $task = $form->getData();

           //Send Mail Confirm
            $send = new ContactMailHelper();

           $this->addFlash(
               'contact_sucess',
               'Votre mail a bien été envoyé'
           );

           $this->addFlash(
               'contact_error',
               'Erreur lors de l\'envoi du mail'
           );

           return $this->redirectToRoute('/');
        }
    }
}