<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 22/02/2018
 * Time: 10:41
 */

namespace App\Subscriber;


use App\Builder\Interfaces\PictureBuilderInterface;
use App\Services\PictureService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ReviewImageSubscriber implements EventSubscriberInterface
{
    /**
     * @var PictureService
     */
    private $pictureService;

    /**
     * @var PictureBuilderInterface
     */
    private $pictureBuilder;

    public function __construct(PictureService $pictureService, PictureBuilderInterface $pictureBuilder)
    {
        $this->pictureService = $pictureService;
        $this->pictureBuilder = $pictureBuilder;
    }

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