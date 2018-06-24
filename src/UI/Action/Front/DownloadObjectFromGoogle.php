<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 24/06/2018
 * Time: 14:06
 */

namespace App\UI\Action\Front;
use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;
use App\UI\Action\Front\Interfaces\DownloadObjectFromGoogleInterface;
use App\UI\Responder\DownloadObjectFromGoogleResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DownloadObjectFromGoogle
 * @Route(
 *     name="dlGoogle",
 *     path="gallery/dl/{slugGallery}/{objectName}"
 * )
 */
final class DownloadObjectFromGoogle implements DownloadObjectFromGoogleInterface
{
    /**
     * @var FileHelperInterface
     */
    private $fileHelper;

    /**
     * @var string
     */
    private $urlStorage;

    /**
     * DownloadObjectFromGoogle constructor.
     *
     * @param FileHelperInterface $fileHelper
     * @param string $urlStorage
     */
    public function __construct(FileHelperInterface $fileHelper, string $urlStorage)
    {
        $this->fileHelper = $fileHelper;
        $this->urlStorage = $urlStorage;
    }

    /**
     * @param Request $request
     * @param DownloadObjectFromGoogleResponder $responder
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request, DownloadObjectFromGoogleResponder $responder)
    {
        $url = $this->urlStorage;

        $image = $request->attributes->get('objectName');

        $gallery = $request->attributes->get('slugGallery');

        $fileName = '/' . $image . '.jpeg';

        $object = $url .  $gallery . $fileName;

//        dump($object, $fileName);
//        die;

//        $this->fileHelper->downloadFile($gallery, $fileName, $object);

        return $responder($object, $fileName);
    }
}
