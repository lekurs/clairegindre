<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 02/05/2018
 * Time: 10:35
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface FaqResponderInterface
{
    /**
     * FaqResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $reviews
     * @param $instagram
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, $reviews, $instagram);
}
