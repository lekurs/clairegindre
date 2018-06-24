<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 24/06/2018
 * Time: 14:06
 */

namespace App\UI\Action\Front;
use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DownloadObjectFromGoogle
 * @Route(
 *     name="dlGoogle",
 *     path="gallery/{slugGallery}/{objectName}"
 * )
 */
class DownloadObjectFromGoogle
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
     * @param FileHelperInterface $fileHelper
     * @param string $urlStorage
     */
    public function __construct(FileHelperInterface $fileHelper, string $urlStorage)
    {
        $this->fileHelper = $fileHelper;
        $this->urlStorage = $urlStorage;
    }


    public function __invoke(Request $request)
    {
        $url = $this->urlStorage;
        $image = $request->attributes->get('objectName');

        $gallery = $request->attributes->get('slugGallery');

        $object = $url . $gallery . $image . '.jpeg';

        dump($gallery);
//        dump($object);
        die;

        $this->fileHelper->downloadFile($object, '/test');
    }
}