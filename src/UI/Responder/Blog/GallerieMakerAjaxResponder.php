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

class GallerieMakerAjaxResponder implements GallerieMakerAjaxResponderInterface
{
    public function __invoke()
    {
        return new JsonResponse([], 200);
    }
}