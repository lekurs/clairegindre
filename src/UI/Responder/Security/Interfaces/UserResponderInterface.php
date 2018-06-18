<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 17:07
 */

namespace App\UI\Responder\Security\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface UserResponderInterface
{
    /**
     * UserResponderInterface constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $addGalleryType
     * @param FormInterface|null $registrationType
     * @param $users
     * @param $pages
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $addGalleryType = null, FormInterface $registrationType = null, $users, $pages);
}