<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 10:06
 */

namespace App\Controller\Front;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Controller\InterfacesController\Front\GalleryCustomerControllerInterface;
use Twig\Environment;

class GalleryCustomerController implements GalleryCustomerControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * GalleryCustomerController constructor.
     * @param Environment $twig
     * @param GalleryBuilderInterface $galleryBuilder
     */
    public function __construct(
        Environment $twig,
        GalleryBuilderInterface $galleryBuilder
    ) {
        $this->twig = $twig;
        $this->galleryBuilder = $galleryBuilder;
    }


    public function __invoke()
    {

    }
}