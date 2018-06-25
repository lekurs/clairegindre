<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 25/06/2018
 * Time: 16:35
 */

namespace App\UI\Responder\Interfaces;


interface DownloadObjectFromGoogleResponderInterface
{
    /**
     * @param string $object
     * @return mixed
     */
    public function __invoke(string $object);
}
