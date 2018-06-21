<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 18:29
 */

namespace App\Subscriber;


use App\Domain\Models\Interfaces\UserInterface;
use App\Subscriber\Interfaces\CommentPostSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class CommentPostSubscriber implements EventSubscriberInterface, CommentPostSubscriberInterface
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

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'manageUserField',
            FormEvents::SUBMIT => 'manageUserAuthentication'
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function manageUserField(FormEvent $event)
    {
        if(!$this->tokenStorage->getToken()->getUser() instanceof UserInterface) {
            $event->getForm()->add('email', EmailType::class, [
                'label' => 'email@email.com',
                'label_attr' => ['class' => 'label-blog'],
                'attr' => ['class' => 'blog-input'],
                'required' => true,
            ]);
            $event->getForm()->add('lastName', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => ['class' => 'label-blog'],
                'attr' => ['class' => 'blog-input'],
                'required' => true,
            ]);
        }
    }

    /**
     * @param FormEvent $event
     */
    public function manageUserAuthentication(FormEvent $event)
    {
        if($this->tokenStorage->getToken()->getUser() instanceof UserInterface) {
            $event->getData()->author = $this->tokenStorage->getToken()->getUser();
        }
    }
}
