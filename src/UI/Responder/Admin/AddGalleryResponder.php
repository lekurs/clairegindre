<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 06/04/2018
 * Time: 11:53
 */

namespace App\UI\Responder\Admin;

use App\UI\Responder\Admin\Interfaces\AddGalleryResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddGalleryResponder implements AddGalleryResponderInterface
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
     * AddGalleryResponder constructor.
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


    public function __invoke($redirect = false, FormInterface $form = null, $user)
    {
        $redirect ? $response = new Response($this->urlGenerator->generate('/admin')) : $response = new Response($this->twig->render('back/admin/add_gallery.html.twig', [
            'gallery' => $form->createView(),
            'user' => $user,
        ]));

        return $response;
    }
}
