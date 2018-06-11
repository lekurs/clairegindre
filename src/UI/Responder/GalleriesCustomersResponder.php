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

final class GalleriesCustomersResponder implements GalleriesCustomersResponderInterface
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
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param bool $redirect
     * @param FormInterface|null $contact
     * @param FormInterface $customerConnectionType
     * @param $galleries
     * @param $insta
     * @param $reviews
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $contact = null, FormInterface $customerConnectionType, $galleries, $insta, $reviews, $pagination)
    {
        $redirect ? $response = new RedirectResponse('/') : $response = new Response($this->twig->render('front/galleries_customer.html.twig', [
            'galleries' => $galleries,
            'contact' => $contact->createView(),
            'customerConnectionType' => $customerConnectionType->createView(),
            'insta' => $insta,
            'reviews' => $reviews,
            'pages' => $pagination
        ]));

        return $response;
    }
}
