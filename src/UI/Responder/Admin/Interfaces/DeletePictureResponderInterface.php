<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 30/04/2018
 * Time: 22:58
 */

namespace App\UI\Responder\Admin\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface DeletePictureResponderInterface
{
    /**
     * DeletePictureResponderInterface constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator);

    /**
     * @return mixed
     */
    public function __invoke();
}
