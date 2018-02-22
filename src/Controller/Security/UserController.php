<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 22:09
 */

namespace App\Controller\Security;


use App\Builder\UserBuilder;
use App\Entity\User;
use App\Type\UserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function show(UserBuilder $userBuilder, Request $request)
    {
        $userBuilder->create();

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

            $task = $this->createForm(UserForm::class, $userBuilder->getUser())->handleRequest($request);

            if($task->isSubmitted() && $task->isValid())
            {

            }

        return $this->render('back/admin/users.html.twig', array(
            'users' => $users,
            'user_form' => $task->createView(),
        ));
    }
}