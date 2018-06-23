<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 23/06/2018
 * Time: 12:52
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\UpdateGalleryOnlineAjaxResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UpdateGalleryOnlineAjaxResponder implements UpdateGalleryOnlineAjaxResponderInterface
{
    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        return new JsonResponse(['sucess'], 200);
    }
}
