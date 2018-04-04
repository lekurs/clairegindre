<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 09:23
 */

namespace App\Controller\InterfacesController;

use App\Builder\PictureBuilder;
use App\Builder\ReviewsBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

interface ReviewsControllerInterface
{
    public function __construct(Environment $twig, PictureBuilder $pictureBuilder, ReviewsBuilder $reviewsBuilder, EntityManagerInterface $manager, FormFactoryInterface $formFactory);

    public function __invoke(Request $request);
}