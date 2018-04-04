<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/03/2018
 * Time: 16:35
 */

namespace App\Controller\InterfacesController\Admin;


use App\Builder\Interfaces\BenefitBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface BenefitControllerInterface
{
    public function __construct(Environment $twig, FormFactoryInterface $form, EntityManagerInterface $manager, BenefitBuilderInterface $benefitBuilder, UrlGeneratorInterface $url);

    public function __invoke(Request $request);

}