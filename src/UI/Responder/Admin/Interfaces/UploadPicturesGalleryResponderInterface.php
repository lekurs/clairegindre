<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/06/2018
 * Time: 13:48
 */

namespace App\UI\Responder\Admin\Interfaces;


use Twig\Environment;

interface UploadPicturesGalleryResponderInterface
{
    /**
     * UploadPicturesGalleryResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @return mixed
     */
    public function __invoke();
}