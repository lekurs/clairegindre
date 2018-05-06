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

class GalleryCustomerResponder implements GalleryCustomerResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * GalleryCustomerResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke($galleries)
    {
        return new Response($this->twig->render('front/gallery_customer.html.twig', [
            'galleries' => $galleries
        ]));
    }

}