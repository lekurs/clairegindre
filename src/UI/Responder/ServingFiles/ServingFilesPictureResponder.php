<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 22:09
 */

namespace App\UI\Responder\ServingFiles;


use App\UI\Responder\ServingFiles\Interfaces\ServingFilesPictureResponderInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Stream;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ServingFilesPictureResponder implements ServingFilesPictureResponderInterface
{
    public function __invoke($file)
    {
        $stream = new Stream($file);

//        $response = new Response($file);

        $response = new BinaryFileResponse($stream);

//        $header = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $file);
//
//        dump($response);

        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $file, null);

//        return $response->headers->set('Content-header', $header);
    }
}