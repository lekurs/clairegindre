<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/04/2018
 * Time: 20:09
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\GalleryCustomerConnectionResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class GalleryCustomerConnectionResponder implements GalleryCustomerConnectionResponderInterface
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
     * GalleryCustomerConnectionResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke($redirect = false, FormInterface $form)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('adminGalleryCustomer')) : $response = new Response($this->twig->render('back/security/gallery_customer_connection.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
