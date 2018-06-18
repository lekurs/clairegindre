<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 14/05/2018
 * Time: 10:03
 */

namespace App\UI\Responder\Blog;


use App\UI\Responder\Interfaces\GallerieMakerResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class GallerieMakerResponder implements GallerieMakerResponderInterface
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
     * GallerieMakerResponder constructor.
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
     * @param $gallery
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, $gallery)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('admin')) : $response = new Response($this->twig->render('back/admin/Article/add_galleriemaker_article.html.twig', [
            'gallery' => $gallery,
        ]));

        return $response;
    }
}
