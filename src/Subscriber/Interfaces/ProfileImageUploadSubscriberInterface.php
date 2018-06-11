<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 14:09
 */

namespace App\Subscriber\Interfaces;


use App\Services\PictureUploaderHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;

interface ProfileImageUploadSubscriberInterface
{
    /**
     * ProfileImageUploadSubscriberInterface constructor.
     *
     * @param Filesystem $fileSystem
     * @param string $targetDir
     * @param PictureUploaderHelper $pictureUploaderHelper
     */
    public function __construct(
        Filesystem $fileSystem,
        string $targetDir,
        PictureUploaderHelper $pictureUploaderHelper
    );
}
