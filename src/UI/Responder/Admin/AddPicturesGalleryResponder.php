<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 17:06
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\AddPicturesGalleryResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddPicturesGalleryResponder implements AddPicturesGalleryResponderInterface
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
     * AddPicturesGalleryResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke($redirect = false)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('adminUser')) : $response = new Response($this->twig->render('back/admin/add_gallery.html.twig', [

        ]));

        return $response;
    }

}