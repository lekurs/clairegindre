<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 14:06
 */

namespace App\Subscriber;


use App\Services\PictureUploaderHelper;
use App\Subscriber\Interfaces\ProfileImageUploadSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvents;

final class ProfileImageUploadSubscriber implements EventSubscriberInterface, ProfileImageUploadSubscriberInterface
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var string
     */
    private $targetDir;

    /**
     * @var PictureUploaderHelper
     */
    private $pictureUploaderHelper;

    /**
     * ProfileImageUploadSubscriber constructor.
     * @param Filesystem $fileSystem
     * @param string $targetDir
     * @param PictureUploaderHelper $pictureUploaderHelper
     */
    public function __construct(
        Filesystem $fileSystem,
        string $targetDir,
        PictureUploaderHelper $pictureUploaderHelper
    ) {
        $this->fileSystem = $fileSystem;
        $this->targetDir = $targetDir;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'onImageUpload'
        ];
    }
}
