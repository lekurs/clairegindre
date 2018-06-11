<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 16:02
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\GalleryCustomerResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class GalleryCustomerResponder implements GalleryCustomerResponderInterface
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
     * GalleryCustomerResponder constructor.
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
     * @param FormInterface|null $form
     * @param $gallery
     * @param $pictures
     * @return mixed|void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null, $gallery, $pictures)
    {
        $redirect ? $response =  new RedirectResponse($this->urlGenerator->generate('index')) : $response = new Response($this->twig->render('front/gallery_customer.html.twig', [
            'contact' => $form->createView(),
            'gallery' => $gallery,
            'pictures' => $pictures
        ]));

        return $response;
    }
}
