<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 05/06/2018
 * Time: 13:45
 */

namespace App\Subscriber;


use App\Domain\Models\Interfaces\UserInterface;
use App\Subscriber\Interfaces\AnswerEmailSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class AnswerEmailSubscriber implements AnswerEmailSubscriberInterface, EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * AnswerEmailSubscriber constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $session
     */
    public function __construct(TokenStorageInterface $tokenStorage, SessionInterface $session)
    {
        $this->tokenStorage = $tokenStorage;
        $this->session = $session;
    }


    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'manageAnswerEmailField',
            FormEvents::SUBMIT => 'manageAnswerEmailSubmit'
        ];
    }

    /**
     * @param FormEvent $event
     * @return mixed|void
     */
    public function manageAnswerEmailField(FormEvent $event)
    {
        if (!$this->tokenStorage->getToken()->getUser() instanceof UserInterface) {
            $event->getForm()->add('from', HiddenType::class);
            $event->getForm()->add('to', HiddenType::class);
        }
    }

    /**
     * @param FormEvent $event
     * @return mixed|void
     */
    public function manageAnswerEmailSubmit(FormEvent $event)
    {
        if ($this->tokenStorage->getToken()->getUser() instanceof UserInterface) {
            $event->getData()->from = $this->tokenStorage->getToken()->getUser()->getEmail();
            $event->getData()->to =$this->session->get('to');
        }
    }
}
