<?php

namespace App\Controller\InterfacesController\Admin;

use App\Builder\CategoryBuilder;
use App\Builder\Interfaces\CategoryBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

interface CategoryControllerInterface
{
    /**
     * CategoryControllerInterface constructor.
     * @param Environment $twig
     * @param CategoryBuilderInterface $categoryBuilder
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $manager
     */
    public function __construct(
        Environment $twig,
        CategoryBuilderInterface $categoryBuilder,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $manager
    );

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request);
}
