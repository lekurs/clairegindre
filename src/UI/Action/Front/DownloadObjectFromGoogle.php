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
 *     path="gallery/{objectName}"
 * )
 */
class DownloadObjectFromGoogle
{
    /**
     * @var FileHelperInterface
     */
    private $fileHelper;

    /**
     * DownloadObjectFromGoogle constructor.
     * @param FileHelperInterface $fileHelper
     */
    public function __construct(FileHelperInterface $fileHelper)
    {
        $this->fileHelper = $fileHelper;
    }

    public function __invoke(Request $request)
    {
        $object = $request->attributes->get('objectName');

        $this->fileHelper->downloadFile($object, '/test');
    }
}