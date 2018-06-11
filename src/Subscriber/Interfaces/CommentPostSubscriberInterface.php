<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/06/2018
 * Time: 11:32
 */

namespace App\Subscriber\Interfaces;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface CommentPostSubscriberInterface
{
    /**
     * CommentPostSubscriberInterface constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage);

    /**
     * @param FormEvent $event
     * @return mixed
     */
    public function manageUserField(FormEvent $event);

    /**
     * @param FormEvent $event
     * @return mixed
     */
    public function manageUserAuthentication(FormEvent $event);

}