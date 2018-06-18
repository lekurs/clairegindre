<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/04/2018
 * Time: 20:10
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface GalleryCustomerConnectionResponderInterface
{
    /**
     * GalleryCustomerConnectionResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface $form
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form);
}
