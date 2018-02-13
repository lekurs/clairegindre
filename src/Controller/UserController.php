<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 22:09
 */

namespace App\Controller;


use App\Entity\Register;
use App\Form\RegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function add(Request $request)
    {
        $task = new RegisterForm();
        $form = $this->createForm(RegisterForm::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $user = new Register();

            $user->setEmail($request->get('emailRegistration'));
            $user->setName($request->get('nameRegistration'));
            $user->setLastname($request->get('lastNameRegistration'));
            $user->setPassword($request->get('passwordRegistration'));
            $user->setDateWedding($request->get('date_wedding'));
            $user->setType($request->get('type'));
            $user->setPicture($request->get('picture'));

            $em->persist($user);
            $em->flush();

            //add flash
            $this->addFlash('addUser_success', 'Utilisateur bien ajouté');
            $this->addFlash('addUser_error', 'Erreur : l\'utilisateur n\'a pas été ajouté');

            return $this->redirectToRoute('/admin');
        }
    }
}