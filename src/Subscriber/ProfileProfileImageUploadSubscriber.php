<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 14:06
 */

namespace App\Subscriber;


use App\Entity\Picture;
use App\Services\PictureUploaderHelper;
use App\Subscriber\Interfaces\ProfileImageUploadSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ProfileProfileImageUploadSubscriber implements EventSubscriberInterface, ProfileImageUploadSubscriberInterface
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
     * ProfileProfileImageUploadSubscriber constructor.
     * @param Filesystem $fileSystem
     * @param string $targetDir
     * @param PictureUploaderHelper $pictureUploaderHelper
     */
    public function __construct(Filesystem $fileSystem, string $targetDir, PictureUploaderHelper $pictureUploaderHelper)
    {
        $this->fileSystem = $fileSystem;
        $this->targetDir = $targetDir;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
    }


    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'onImageUpload'
        ];
    }

    public function onImageUpload(FormEvent $event)
    {
        try {
            $this->fileSystem->mkdir($this->targetDir . '/customers', 0777);
        } catch (IOExceptionInterface $exception) {
            echo "une erreur est survenue durant la création du répertoire : ".$exception->getPath();
        }
        $this->pictureUploaderHelper->move($event->getData(), $this->targetDir . '/customers/', $event->getData()->getClientOriginalName());
        $picture = new Picture($event->getData()->getClientOriginalName(), '/images/upload/customers', $event->getData()->guessClientExtension());
        $event->getForm()->getParent()->getData()->setPicture($picture);
    }
}