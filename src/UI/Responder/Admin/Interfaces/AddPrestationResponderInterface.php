<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 09/04/2018
 * Time: 12:25
 */

namespace App\UI\Responder\Admin\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddPrestationResponderInterface
{
    /**
     * AddPrestationResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $benefits
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, $benefits);
}