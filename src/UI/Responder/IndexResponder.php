<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:59
 */

namespace App\UI\Responder;


use App\Domain\Lib\InstagramLib;
use App\UI\Responder\Interfaces\IndexResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class IndexResponder implements IndexResponderInterface
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
     * IndexResponder constructor.
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

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $instagram
     * @param $reviews
     * @param $galleries
     * @return mixed|RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null, $instagram, $reviews, $galleries)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('index')) : $response = new Response($this->twig->render('front/index.html.twig', array(
            'contact' => $form->createView(),
            'insta' => $instagram,
            'reviews' => $reviews,
            'galleries' => $galleries
        )));

        return $response;
    }
}
