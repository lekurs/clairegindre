<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 16:26
 */

namespace App\Controller\Security;


use App\Builder\Interfaces\PictureBuilderInterface;
use App\Builder\Interfaces\UserBuilderInterface;
use App\Services\PictureUploaderHelper;
use App\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder, UserBuilderInterface $userBuilder, PictureUploaderHelper $pictureService, PictureBuilderInterface $pictureBuilder)
    {
        $userBuilder->create();
//        $pictureBuilder->create();

        $register = $this->createForm(RegistrationType::class, $userBuilder->getUser())->handleRequest($request);

        if($register->isSubmitted() && $register->isValid()) {
            $password = $encoder->encodePassword($userBuilder->getUser(), $userBuilder->getUser()->getPlainPassword());
            $userBuilder->withPassword($password);

            $userBuilder->withRole('ROLE_ADMIN');

            $em = $this->getDoctrine()->getManager();
            $em->persist($userBuilder->getUser());
            $em->flush();

            //FlashMessages
            $this->addFlash('register_success', 'Utilisateur bien ajouté');

            return $this->redirectToRoute('admin');
        }

        return $this->render('back/admin/register.html.twig', array(
            'register' => $register->createView(),
        ));
    }
}