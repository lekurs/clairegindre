<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 21/06/2018
 * Time: 13:54
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\UpdateOnlineUserAjaxResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UpdateReviewOnlineAjaxResponder implements UpdateOnlineUserAjaxResponderInterface
{
    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        return new JsonResponse(['success'], 200);
    }
}
