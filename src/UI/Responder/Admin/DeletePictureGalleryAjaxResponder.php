<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 22:21
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\DeletePictureGalleryAjaxResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DeletePictureGalleryAjaxResponder implements DeletePictureGalleryAjaxResponderInterface
{
    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response('success');
    }
}
