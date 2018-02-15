<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 16:26
 */

namespace App\Controller\Security;


use App\Builder\Interfaces\UserBuilderInterface;
use App\Entity\Category;
use App\Type\UserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder, UserBuilderInterface $userBuilder)
    {

        $title = "Inscrire un nouveau client";

        $userBuilder->create();

        $register = $this->createForm(UserForm::class, $userBuilder->getUser())->handleRequest($request);

        if($register->isSubmitted() && $register->isValid())
        {
            $pictureName = $this->generateUniqueFileName().'.'.$register->getData()->getPicture()->guessExtension();

            $register->getData()->getPicture()->move(
                $this->getParameter('customer_directory'),
                $pictureName
            );

            $userBuilder->withPicture($pictureName);

            $password = $encoder->encodePassword($userBuilder->getUser(), $userBuilder->getUser()->getPlainPassword());
            $userBuilder->withPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($userBuilder->getUser());
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