<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 17:25
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\GalleriesCustomersResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class GalleriesCustomersResponder implements GalleriesCustomersResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * GalleriesCustomersResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }


    public function __invoke($redirect = false, FormInterface $form = null, $galleries, $insta)
    {
        $redirect ? $response = new RedirectResponse('/') : $response = new Response($this->twig->render('front/galleries_customer.html.twig', [
            'galleries' => $galleries,
            'contact' => $form->createView(),
            'insta' => $insta
        ]));

        return $response;
    }
}