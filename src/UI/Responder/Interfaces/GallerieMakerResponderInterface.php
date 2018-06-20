<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 14/05/2018
 * Time: 10:03
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface GallerieMakerResponderInterface
{
    /**
     * GallerieMakerResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param $gallery
     * @return mixed
     */
    public function __invoke($redirect = false, $gallery, $pictures);
}
