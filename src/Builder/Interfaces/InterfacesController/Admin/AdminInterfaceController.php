<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/03/2018
 * Time: 16:18
 */

namespace App\Builder\Interfaces\InterfacesController\Admin;


use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

interface AdminInterfaceController
{
    public function __invoke(Request $request, Environment $environment);
}