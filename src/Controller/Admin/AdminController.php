<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 22:26
 */

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function show()
    {
        $title = 'Bienvenue dans l\'administration';

        return $this->render('back/admin/admin.html.twig', array(
            'title' => $title,
        ));
    }

}