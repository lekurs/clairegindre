<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 24/06/2018
 * Time: 15:55
 */

namespace App\UI\Responder;


use Symfony\Component\HttpFoundation\Response;

class DownloadObjectFromGoogleResponder
{
    public function __invoke($object, $filename)
    {
        $file = $object;


        header('Content-Type: application/octet-stream');
        header('Content-disposition: attachment; filename='.basename($file));
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        readfile($file);
        exit();

//        $response = new Response();
//
//        $response->headers->set('Content-Type', 'application/octet-stream');
//        $response->headers->set('Pragma' ,'no-cache');
//        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
//        $response->headers->set('Content-Disposition', 'attachment; filename = ' . basename($file));
//        $response->headers->set('Expires', 0);
//
//        readfile($file);
//        exit();

//        return $response;
    }
}