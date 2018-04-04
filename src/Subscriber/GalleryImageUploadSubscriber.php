<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/03/2018
 * Time: 15:25
 */

namespace App\Subscriber;



use App\Domain\Models\Picture;
use App\Services\PictureUploaderHelper;
use App\Subscriber\Interfaces\GalleryImageUploadSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GalleryImageUploadSubscriber implements EventSubscriberInterface, GalleryImageUploadSubscriberInterface
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var PictureUploaderHelper
     */
    private $pictureUploadHelper;

    /**
     * @var string
     */
    private $targetDir;

    /**
     * GalleryImageUploadSubscriber constructor.
     * @param Filesystem $fileSystem
     * @param PictureUploaderHelper $pictureUploadHelper
     * @param string $targetDir
     */
    public function __construct(
        Filesystem $fileSystem,
        PictureUploaderHelper $pictureUploadHelper,
        string $targetDir
    ) {
        $this->fileSystem = $fileSystem;
        $this->pictureUploadHelper = $pictureUploadHelper;
        $this->targetDir = $targetDir;
    }

        public static function getSubscribedEvents()
        {
            return [
               FormEvents::SUBMIT => 'onGalleryUpload',
            ];
        }

        public function onGalleryUpload(FormEvent $event)
        {
            foreach ($event->getData() as $image) {
                $this->pictureUploadHelper->move($image, $this->targetDir . '/gallery/' . $event->getForm()->getParent()->getData()->getId(), $image->getClientOriginalName());
                $picture = new Picture($image->getClientOriginalName(), 'images/upload/gallery/' . $event->getForm()->getParent()->getData()->getId(), $image->guessClientExtension());
                $picture->setGallery($event->getForm()->getParent()->getData());
                $event->getForm()->getParent()->getData()->setPictures($picture);
            }
        }
}
