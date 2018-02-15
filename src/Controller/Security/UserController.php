<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 22:09
 */

namespace App\Controller\Security;


use App\Entity\Register;
use App\Entity\User;
use App\Type\UserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function show()
    {
        $title = 'Administration des clients';

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        var_dump($users);

        return $this->render('back/admin/users.html.twig', array(
            'title' => $title,
            'users' => $users,
        ));
    }
}