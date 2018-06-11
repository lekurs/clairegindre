<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:23
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\AddArticleResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class AddArticleResponder implements AddArticleResponderInterface
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
     * AddArticleResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $rulGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $rulGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $rulGenerator;
    }

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $gallery
     * @return mixed|RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null, $gallery)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('adminGallerieMaker', ['slugGallery' => $gallery->getSlug(), 'slugArticle' => $gallery->getArticle()->getSlug()])) : $response = new Response($this->twig->render('back/admin/Article/add_article.html.twig', [
            'form' => $form->createView(),
            'gallery' => $gallery
        ]));

        return $response;
    }
}
