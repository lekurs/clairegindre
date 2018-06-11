<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 31/05/2018
 * Time: 14:42
 */

namespace App\Subscriber;


use App\Services\SlugHelper;
use App\Subscriber\Interfaces\EditUserSlugSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class EditUserSlugSubscriber implements EventSubscriberInterface, EditUserSlugSubscriberInterface
{
    /**
     * @var SlugHelper
     */
    private $slugHelper;

    /**
     * EditUserSlugSubscriber constructor.
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

    /**
     * @param FormEvent $event
     * @return mixed|void
     */
    public function onSubmit(FormEvent $event)
    {
        $event->getData()->slug = $this->slugHelper->replace($event->getData()->username . '-' . $event->getData()->lastName);
    }
}
