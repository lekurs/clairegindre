<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 10/05/2018
 * Time: 18:16
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface EditArticleResponderInterface
{
    /**
     * EditArticleResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $articles
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, $articles);
}
