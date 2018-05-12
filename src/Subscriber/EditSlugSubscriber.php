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
    public static function getSubscribedEvents()
    {
        return [
           FormEvents::SUBMIT => 'onSubmit'
        ];
    }

    public function onSubmit(FormEvent $event)
    {
        $slugHelper = new SlugHelper();

        dump($event->getForm());
        die();

        $event->setData($slugHelper->replace($event->getData()->title));
    }
}
