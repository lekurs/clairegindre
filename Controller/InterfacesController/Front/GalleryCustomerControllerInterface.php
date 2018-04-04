<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 10:03
 */

namespace App\Controller\InterfacesController\Front;


use App\Builder\Interfaces\GalleryBuilderInterface;
use Twig\Environment;

interface GalleryCustomerControllerInterface
{
    public function __construct(Environment $twig, GalleryBuilderInterface $galleryBuilder);

    public function __invoke();
}