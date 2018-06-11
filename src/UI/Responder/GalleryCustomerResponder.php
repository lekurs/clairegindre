<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 16:02
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\GalleryCustomerResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class GalleryCustomerResponder implements GalleryCustomerResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * GalleryCustomerResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $gallery
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($gallery)
    {
        return new Response($this->twig->render('front/gallery_customer.html.twig', [
            'gallery' => $gallery
        ]));
    }
}
