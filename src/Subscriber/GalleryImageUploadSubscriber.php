<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/03/2018
 * Time: 15:25
 */

namespace App\Subscriber;


use App\Entity\Gallery;
use App\Entity\Picture;
use App\Entity\User;
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
     * @var User
     */
    private $user;

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
               FormEvents::SUBMIT => 'onGalleryUpload'
            ];
        }

        public function onGalleryUpload(FormEvent $event)
        {
            foreach ($event->getData() as $image) {
                dump($event->getData());
                $this->pictureUploadHelper->move($image, $this->targetDir . '/gallery', $image->getClientOriginalName());
                $picture = new Picture($image->getClientOriginalName(), $this->targetDir . '/gallery', $image->guessClientExtension());
            dump($picture);
                dump($event->getForm()->getParent()->getData());
//            die();
                $event->getForm()->getParent()->getData()->setPicture($picture);
            }
        }
}