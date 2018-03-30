<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/03/2018
 * Time: 14:20
 */

namespace App\Controller\InterfacesController\Admin;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Builder\Interfaces\UserBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

interface UserControllerInterface
{

    public function __construct(Environment $twig, EntityManagerInterface $entityManager, UserBuilderInterface $userBuilder, GalleryBuilderInterface $galleryBuilder);

    public function __invoke(Request $request);

}