<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/02/2018
 * Time: 16:31
 */

namespace App\Controller\Admin;


use App\Builder\UserBuilder;
use App\Entity\User;
use App\Type\UserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserEditController extends Controller
{
    public function edit($id)
    {
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository(User::class)->find($id);
//

    }
}