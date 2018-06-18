<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 16:49
 */

namespace App\Subscriber\Interfaces;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;

interface UserFolderSubscriberInterface
{
    /**
     * UserFolderSubscriberInterface constructor.
     *
     * @param Filesystem $fileSystem
     * @param string $targetDir
     */
    public function __construct(Filesystem $fileSystem, string $targetDir);

    /**
     * @param FormEvent $formEvent
     * @return mixed
     */
    public function onUserFolder(FormEvent $formEvent);
}
