<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/01/2018
 * Time: 16:04
 */

namespace App\Controller;


use App\Type\ContactForm;
use App\Lib\ContactMailLib;
use App\Lib\InstagramLib;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function index(Request $request, ContactMailLib $contactMailHelper, InstagramLib $insta)
    {
      $title = "Bienvenue sur le site de Claire GINDRE - Photographe";

      $json = $insta->show();


      $contactForm = new ContactForm();
      $contact = $this->createForm(ContactForm::class);

      $contact->handleRequest($request);

      if($contact->isSubmitted() && $contact->isValid())
      {
          $contactForm = $contact->getData();

          //Send Mail Confirm
          $contactMailHelper->send($request);

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

      return $this->render('front/index.html.twig', array(
        'title' => $title,
        'json' => $json,
        'contact' => $contact->createView(),
          ));
    }
}