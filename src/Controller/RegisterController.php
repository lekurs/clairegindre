<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 16:26
 */

namespace App\Controller;


use App\Form\RegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegisterController extends Controller
{
    public function show()
    {

        $title = "Inscrire un nouveau client";

        $register = $this->createForm(RegisterForm::class, array(
            'action' => $this->generateUrl('adminAddUser'),
            'method' => 'POST',
        ));

        return $this->render('back/admin/register.html.twig', array(
            'title' => $title,
            'register' => $register->createView(),
        ));
    }
}