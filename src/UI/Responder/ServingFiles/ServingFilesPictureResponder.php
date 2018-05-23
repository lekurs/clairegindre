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
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ServingFilesPictureResponder implements ServingFilesPictureResponderInterface
{
    public function __invoke($file)
    {
//        $stream = new Stream($file);

        $response = new BinaryFileResponse($file);

        $mime = new FileinfoMimeTypeGuesser();

        if ($mime->isSupported()) {
            $response->headers->set('Content-type', $mime->guess($file));
            dump('ok');
        }

        BinaryFileResponse::trustXSendfileTypeHeader();

        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $file);

        dump($response);

        return $response;
    }
}