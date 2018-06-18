<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 16:02
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface GalleryCustomerResponderInterface
{
    /**
     * GalleryCustomerResponderInterface constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $gallery
     * @param $pictures
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, $gallery, $pictures);
}
