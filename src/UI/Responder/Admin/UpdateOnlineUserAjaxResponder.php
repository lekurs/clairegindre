<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 20:35
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\UpdateOnlineUserAjaxResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UpdateOnlineUserAjaxResponder implements UpdateOnlineUserAjaxResponderInterface
{
    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        return new JsonResponse('success', 200);
    }
}
