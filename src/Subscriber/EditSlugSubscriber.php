<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 22:35
 */

namespace App\Subscriber;


use App\Services\SlugHelper;
use App\Subscriber\Interfaces\EditSlugSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class EditSlugSubscriber implements EventSubscriberInterface, EditSlugSubscriberInterface
{
    /**
     * @var SlugHelper
     */
    private $slugHelper;

    /**
     * EditSlugSubscriberInterface constructor.
     * @param SlugHelper $slugHelper
     */
    public function __construct(SlugHelper $slugHelper)
    {
        $this->slugHelper = $slugHelper;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
           FormEvents::SUBMIT => 'onSubmit'
        ];
    }

    /**
     * @param FormEvent $event
     * @return mixed|void
     */
    public function onSubmit(FormEvent $event)
    {
        $event->getData()->slug = $this->slugHelper->replace($event->getData()->title);
    }
}
