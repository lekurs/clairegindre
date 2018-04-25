<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 17:50
 */

namespace App\UI\Responder\Blog;


use App\UI\Responder\Interfaces\ArticleShowGalleryResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ArticleShowGalleryResponder implements ArticleShowGalleryResponderInterface
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
     * ArticleShowGalleryResponder constructor.
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
     * @param FormInterface $form
     * @param $instagram
     * @param $gallery
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form, $instagram, $gallery)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('index')) : $response = new Response($this->twig->render('front/ArticleShowGallery.html.twig', array(
            'galleries' => $gallery,
            'contact' => $form->createView(),
            'insta' => $instagram
        )));

        return $response;
    }
}
