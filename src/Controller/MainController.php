<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/01/2018
 * Time: 16:04
 */

namespace App\Controller;


use App\Form\ContactForm;
use App\Helper\InstagramHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class MainController extends Controller
{
    public function index()
    {
      $title = "Bienvenue sur le site de Claire GINDRE - Photographe";

      $insta = new InstagramHelper();
      $json = $insta->show();

      $contact = $this->createForm(ContactForm::class, array(
          'action' => $this->generateUrl('contactPost'),
          'method' => 'POST',
      ));

      return $this->render('front/index.html.twig', array(
        'title' => $title,
        'json' => $json,
        'contact' => $contact->createView(),
          ));
    }
}