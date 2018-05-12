<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 13:56
 */

namespace App\UI\Action\Blog;


use App\UI\Action\Blog\Interfaces\GallerieMakerAjaxActionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GallerieMakerAjaxAction
 *
 * @Route(
 *     name="adminGallerieMaker",
 *     path="admin/article/edit/{slugArticle}",
 *     methods={"POST"}
 * )
 *
 */
class GallerieMakerAjaxAction implements GallerieMakerAjaxActionInterface
{
    public function __invoke()
    {
        dump('ok');
        die();
    }

}