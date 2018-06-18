<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 16:49
 */

namespace App\Subscriber;


use App\Subscriber\Interfaces\UserFolderSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class UserFolderSubscriber implements UserFolderSubscriberInterface, EventSubscriberInterface
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
     * UserFolderSubscriber constructor.
     * @param Filesystem $fileSystem
     * @param string $targetDir
     */
    public function __construct(Filesystem $fileSystem, string $targetDir)
    {
        $this->fileSystem = $fileSystem;
        $this->targetDir = $targetDir;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
           FormEvents::SUBMIT => 'onUserFolder'
        ];
    }

    /**
     * @param FormEvent $formEvent
     */
    public function onUserFolder(FormEvent $formEvent)
    {
        try {
            $this->fileSystem->mkdir($this->targetDir . '/' . $formEvent->getData(), 0777);
        } catch (IOExceptionInterface $exception) {
            echo "une erreur est survenue durant la création du répertoire : ".$exception->getPath();
        }
    }
}
