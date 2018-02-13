<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 16:26
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Register;
use App\Form\RegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {

        $title = "Inscrire un nouveau client";

        $user = new Register();

        $register = $this->createForm(RegisterForm::class, $user);

        $register->handleRequest($request);

        if($register->isSubmitted() && $register->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $picture = $user->getPicture();

            $pictureName = $this->generateUniqueFileName().'.'.$picture->guessExtension();

            $picture->move(
                $this->getParameter('customer_directory'),
                $pictureName
            );

            $user->setPicture($pictureName);

            $em->persist($user);
            $em->flush();

            //FlashMessages
            $this->addFlash('register_success', 'Utilisateur bien ajouté');
            $this->addFlash('register_error', 'Erreur : l\'utilisateur n\'a pas été ajouté');

            return $this->redirectToRoute('admin');
        }

        return $this->render('back/admin/register.html.twig', array(
            'title' => $title,
            'register' => $register->createView(),
        ));
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}