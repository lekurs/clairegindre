<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 18:29
 */

namespace App\Subscriber;


use App\Domain\Models\Interfaces\UserInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommentPostSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * CommentPostSubscriber constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'manageUserField',
            FormEvents::SUBMIT => 'manageUserAuthentication'
        ];
    }

    public function manageUserField(FormEvent $event)
    {
        if(!$this->tokenStorage->getToken()->getUser() instanceof UserInterface) {
            $event->getForm()->add('email', EmailType::class);
            $event->getForm()->add('lastName', TextType::class);
        }
    }

    public function manageUserAuthentication(FormEvent $event)
    {
        if($this->tokenStorage->getToken()->getUser() instanceof UserInterface) {
            $event->getData()->author = $this->tokenStorage->getToken()->getUser();
        }
    }
}
