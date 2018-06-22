<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 22/06/2018
 * Time: 09:13
 */

namespace App\Services;


use App\Services\Interfaces\ResizeImageHelperInterface;

final class ResizeImageHelper implements ResizeImageHelperInterface
{
    public function resize(\SplFileInfo $image)
    {
        $newPicture = imagecreatefromjpeg($image);

        $pictureSize = getimagesize($image);

        $createWithTrueColor = imagecreatetruecolor('width', 'height');
    }
}