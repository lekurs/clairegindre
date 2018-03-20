<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:39
 */

namespace App\Builder\Interfaces\InterfacesController;


use App\Builder\CategoryBuilder;
use App\Lib\InstagramLib;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

interface BlogControllerInterface
{
    public function __construct(Environment $twig, FormFactoryInterface $formFactory, InstagramLib $insta, CategoryBuilder $categoryBuilder);

    public function __invoke(Request $request);

}