<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 17:06
 */

namespace App\UI\Responder\Admin\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddPicturesGalleryResponderInterface
{
    /**
     * AddPicturesGalleryResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param $gallery
     * @param $pictures
     * @return mixed
     */
    public function __invoke($redirect = false, $gallery, $pictures);
}
