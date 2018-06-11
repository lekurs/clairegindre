<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 15:52
 */

namespace App\UI\Responder\Admin\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface DeleteGalleryResponderInterface
{
    /**
     * DeleteGalleryResponderInterface constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator);

    /**
     * @return mixed
     */
    public function __invoke();
}
