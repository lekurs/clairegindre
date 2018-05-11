<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 22/02/2018
 * Time: 10:41
 */

namespace App\Subscriber;


use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Services\PictureUploaderHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ReviewImageSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
           FormEvents::SUBMIT => 'onSubmit',
        ];
    }

    public function onSubmit(FormEvent $event)
    {
        if(!$event->getData()) {
            return;
        }
        $pictureName = $this->pictureService->move($event->getData());
        $this->pictureBuilder->create()->withName($pictureName);

        $event->setData($this->pictureBuilder->getPicture());
    }
}