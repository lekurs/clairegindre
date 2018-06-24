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
        $file = file_put_contents($filename, $object);

//        dump($file, $filename);
//        die;

        $response = new Response();

        $response->headers->set('Content-Type' ,'application/force-download');
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Type', 'application/download');
//        $response->headers->set('Content-Disposition', 'attachment; filename = " ' . $object);

//        readfile($object);

        return $response;
    }
}