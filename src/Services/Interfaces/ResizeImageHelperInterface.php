<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 22/06/2018
 * Time: 09:14
 */

namespace App\Services\Interfaces;


interface ResizeImageHelperInterface
{
    /**
     * @param \SplFileInfo $image
     * @param $directory
     * @param $newName
     * @return mixed
     */
    public function resize(\SplFileInfo $image, $directory, $newName);
}