<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 22/02/2018
 * Time: 14:51
 */

namespace App\Controller\Security;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    public function login(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();

        $lastUsername = $authUtils->getLastUsername();

        return $this->render('back/security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
}