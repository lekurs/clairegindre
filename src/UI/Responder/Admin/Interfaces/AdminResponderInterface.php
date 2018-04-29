<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 11:25
 */

namespace App\UI\Responder\Admin\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AdminResponderInterface
{
    /**
     * AdminResponderInterface constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param FormInterface $form2
     * @param FormInterface $form3
     * @param $users
     * @param $galleries
     * @param $benefits
     * @param $articles
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, FormInterface $form2, FormInterface $form3, $users, $galleries, $benefits, $articles);
}