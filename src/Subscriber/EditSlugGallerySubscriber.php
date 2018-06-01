<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 31/05/2018
 * Time: 16:04
 */

namespace App\Subscriber;


use App\Services\SlugHelper;
use App\Subscriber\Interfaces\EditSlugGallerySubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EditSlugGallerySubscriber implements EventSubscriberInterface, EditSlugGallerySubscriberInterface
{
    /**
     * @var SlugHelper
     */
    private $slugHelper;

    /**
     * EditSlugGallerySubscriber constructor.
     * @param SlugHelper $slugHelper
     */
    public function __construct(SlugHelper $slugHelper)
    {
        $this->slugHelper = $slugHelper;
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'onSubmit'
        ];
    }

    public function onSubmit(FormEvent $event)
    {
        $event->getData()->slug = $this->slugHelper->replace($event->getData()->title);
    }
}
