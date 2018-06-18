<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 19:22
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\UpdateOnlineArticleAjaxResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UpdateOnlineArticleAjaxResponder implements UpdateOnlineArticleAjaxResponderInterface
{
    public function __invoke()
    {
        return new JsonResponse('success', 200);
    }
}
