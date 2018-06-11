<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 09/04/2018
 * Time: 12:24
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\AddPrestationResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class AddPrestationResponder implements AddPrestationResponderInterface
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
     * AddPrestationResponder constructor.
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

    public function __invoke($redirect = false, FormInterface $form = null, $benefits)
    {
        $redirect ? $response = new Response($this->urlGenerator->generate('/admin')) : $response = new Response($this->twig->render('back/admin/benefit.html.twig', [
            'form' => $form->createView(),
            'benefits' => $benefits,
        ]));
        return $response;
    }
}
