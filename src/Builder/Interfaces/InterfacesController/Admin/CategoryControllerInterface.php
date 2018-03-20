<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 11:22
 */

namespace App\Builder\Interfaces\InterfacesController\Admin;


use App\Builder\BenefitBuilder;
use App\Builder\CategoryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

interface CategoryControllerInterface
{
    public function __construct(
        Environment $twig,
        CategoryBuilder $categoryBuilder,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $manager
    );

    public function __invoke(Request $request);

}