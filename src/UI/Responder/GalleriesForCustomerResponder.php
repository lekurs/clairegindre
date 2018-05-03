<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 14:59
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\GalleriesForCustomerResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class GalleriesForCustomerResponder implements GalleriesForCustomerResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * GalleriesForCustomerResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public  function __invoke($gallery, $instagram)
    {
        return new Response($this->twig->render('front/all_galleries_for_customer.html.twig', [
            'galleries' => $gallery,
            'insta' => $instagram
        ]));
    }


}