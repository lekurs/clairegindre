<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 15:53
 */

namespace App\UI\Responder\Blog;


use App\UI\Responder\Interfaces\GallerieMakerAjaxResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GallerieMakerAjaxResponder implements GallerieMakerAjaxResponderInterface
{
    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        return new JsonResponse(['success'], 200);
    }
}
