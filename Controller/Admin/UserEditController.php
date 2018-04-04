<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/02/2018
 * Time: 16:31
 */

namespace App\Controller\Admin;


use App\Builder\Interfaces\UserBuilderInterface;
use App\Builder\UserBuilder;
use App\Entity\User;
use App\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserEditController extends Controller
{
    public function edit($id, Request $request, UserBuilderInterface $userBuilder)
    {

        $form = $this->createForm(RegistrationType::class);

        if($form->isSubmitted() && $form->isValid())
        {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        }


        return $this->render('back/admin/editUser.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}