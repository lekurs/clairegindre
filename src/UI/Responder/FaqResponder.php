<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 02/05/2018
 * Time: 10:35
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\FaqResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class FaqResponder implements FaqResponderInterface
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
     * FaqResponder constructor.
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
     * @param $reviews
     * @param $instagram
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null, $reviews, $instagram)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('index')) : $response = new Response($this->twig->render('front/faq.html.twig', [
            'contact' => $form->createView(),
            'reviews' => $reviews,
            'insta' => $instagram
        ]));

        return $response;
    }
}
