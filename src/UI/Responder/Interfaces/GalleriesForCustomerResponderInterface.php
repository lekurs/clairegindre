<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 14:59
 */

namespace App\UI\Responder\Interfaces;


use Twig\Environment;

interface GalleriesForCustomerResponderInterface
{
    /**
     * GalleriesForCustomerResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param $gallery
     * @param $instagram
     * @return mixed
     */
    public  function __invoke($gallery, $instagram);
}
