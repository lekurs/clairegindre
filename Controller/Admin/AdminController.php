<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 22:26
 */

namespace App\Controller\Admin;


use App\Controller\InterfacesController\Admin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminController implements Admin\AdminInterfaceController
{
    /**
     * @Route(name="admin", path="admin", methods={"GET"})
     */
    public function __invoke(Request $request, Environment $environment)
    {
        return new Response($environment->render('back/admin/admin.html.twig', array(

        )));
    }

}