<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 22:35
 */

namespace App\Subscriber;


use App\Services\SlugHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EditSlugSubscriber implements EventSubscriberInterface
{
    /**
     * @var SlugHelper
     */
    private $slugHelper;

    /**
     * EditSlugSubscriber constructor.
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
