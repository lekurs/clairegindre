<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/03/2018
 * Time: 14:10
 */

namespace App\Controller\InterfacesController\Admin;


use App\Builder\Interfaces\GalleryBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface GalleryEditControllerInterface
{
    public function __construct(Environment $tiwg, FormFactoryInterface $form, GalleryBuilderInterface $galleryBuilder, EntityManagerInterface $entityManager, UrlGeneratorInterface $url);

    public function __invoke(Request $request);

}