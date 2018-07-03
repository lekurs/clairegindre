<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 24/06/2018
 * Time: 15:55
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\DownloadObjectFromGoogleResponderInterface;

class DownloadObjectFromGoogleResponder implements DownloadObjectFromGoogleResponderInterface
{
    /**
     * @param string $object
     */
    public function __invoke(string $object)
    {
        $file = $object;

        header('Content-Type: application/octet-stream');
        header('Content-disposition: attachment; filename='.basename($file));
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        readfile($file);
        exit();
    }
}
