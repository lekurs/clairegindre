<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 23:23
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\UpdateFavoritePictureGalleryResponderInterface;
use Symfony\Component\HttpFoundation\Response;

class UpdateFavoritePictureGalleryAjaxResponder implements UpdateFavoritePictureGalleryResponderInterface
{
    public function __invoke()
    {
        return new Response('success');
    }
}