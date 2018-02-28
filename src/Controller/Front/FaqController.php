<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 28/02/2018
 * Time: 15:27
 */

namespace App\Controller\Front;


use App\Lib\InstagramLib;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FaqController extends Controller
{
    public function show(InstagramLib $insta)
    {
        $contactType = $this->createForm('App\Type\ContactForm');

        $instagram = $insta->show();

        return $this->render('front/faq.html.twig', array(
            'contact' => $contactType->createView(),
            'json' => $instagram
        ));
    }
}