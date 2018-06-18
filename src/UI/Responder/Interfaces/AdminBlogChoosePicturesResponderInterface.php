<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 11:18
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AdminBlogChoosePicturesResponderInterface
{
    /**
     * AdminBlogChoosePicturesResponderInterface constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param null $gallery
     * @return mixed
     */
    public function __invoke($redirect = false, $gallery = null);
}
