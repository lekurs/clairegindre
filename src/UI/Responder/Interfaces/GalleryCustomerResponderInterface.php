<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 16:02
 */

namespace App\UI\Responder\Interfaces;


use Twig\Environment;

interface GalleryCustomerResponderInterface
{
    /**
     * GalleryCustomerResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param $gallery
     * @return mixed
     */
    public function __invoke($gallery);
}
