<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 05/06/2018
 * Time: 13:45
 */

namespace App\Subscriber\Interfaces;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface AnswerEmailSubscriberInterface
{
    /**
     * AnswerEmailSubscriberInterface constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface $session
     */
    public function __construct(TokenStorageInterface $tokenStorage, SessionInterface $session);

    /**
     * @param FormEvent $event
     * @return mixed
     */
    public function manageAnswerEmailField(FormEvent $event);

    /**
     * @param FormEvent $event
     * @return mixed
     */
    public function manageAnswerEmailSubmit(FormEvent $event);
}
