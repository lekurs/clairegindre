<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 24/06/2018
 * Time: 15:29
 */

namespace App\UI\Action\Front\Interfaces;


use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;
use App\UI\Responder\DownloadObjectFromGoogleResponder;
use Symfony\Component\HttpFoundation\Request;

interface DownloadObjectFromGoogleInterface
{
    /**
     * DownloadObjectFromGoogleInterface constructor.
     * @param FileHelperInterface $fileHelper
     * @param string $urlStorage
     */
    public function __construct(FileHelperInterface $fileHelper, string $urlStorage);

    /**
     * @param Request $request
     * @param DownloadObjectFromGoogleResponder $responder
     * @return mixed
     */
    public function __invoke(Request $request, DownloadObjectFromGoogleResponder $responder);
}
