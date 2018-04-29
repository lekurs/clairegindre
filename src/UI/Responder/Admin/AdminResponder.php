<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 11:25
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\AdminResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AdminResponder implements AdminResponderInterface
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
     * AdminResponder constructor.
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
     * @param FormInterface|null $form2
     * @param FormInterface|null $form3
     * @param $users
     * @param $galleries
     * @param $benefits
     * @param $articles
     * @return mixed|RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null, FormInterface $form2 = null, FormInterface $form3 = null, $users, $galleries, $benefits, $articles)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('admin')) : $response = new Response($this->twig->render('back/admin/admin.html.twig', [
            'users' => $users,
            'galleries' => $galleries,
            'benefits' => $benefits,
            'articles' => $articles,
            'formRegistration' => $form->createView(),
            'formBenefit' => $form2->createView(),
            'formArticle' => $form3->createView()
        ]));

        return $response;
    }
}