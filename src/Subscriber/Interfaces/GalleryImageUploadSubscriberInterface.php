<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/03/2018
 * Time: 15:24
 */

namespace App\Subscriber\Interfaces;


use App\Services\PictureUploaderHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;

interface GalleryImageUploadSubscriberInterface
{
    /**
     * GalleryImageUploadSubscriberInterface constructor.
     *
     * @param Filesystem $fileSystem
     * @param PictureUploaderHelper $pictureUploadHelper
     * @param string $targetDir
     */
    public function __construct(
        Filesystem $fileSystem,
        PictureUploaderHelper $pictureUploadHelper,
        string $targetDir
    );

    /**
     * @param FormEvent $event
     * @return mixed
     */
    public function onGalleryUpload(FormEvent $event);
}
