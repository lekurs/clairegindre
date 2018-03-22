<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/03/2018
 * Time: 13:40
 */

namespace App\Controller\InterfacesController;

use App\Builder\BenefitBuilder;
use App\Builder\GalleryBuilder;
use App\Builder\PictureBuilder;
use App\Builder\UserBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

interface GalleryControllerInterface
{
    public function __invoke($id, Request $request);

    public function __construct(GalleryBuilder $galleryBuilder, PictureBuilder $pictureBuilder, BenefitBuilder $benefitBuilder, UserBuilder $userBuilder, Environment $environment, EntityManagerInterface $entityManager, FormFactoryInterface $form);
}