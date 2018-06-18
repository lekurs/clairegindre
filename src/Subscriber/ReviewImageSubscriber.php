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
use App\Subscriber\Interfaces\ReviewImageSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ReviewImageSubscriber implements EventSubscriberInterface, ReviewImageSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
           FormEvents::SUBMIT => 'onSubmit',
        ];
    }

    /**
     * @param FormEvent $event
     */
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
