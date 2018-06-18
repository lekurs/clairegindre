<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/06/2018
 * Time: 11:42
 */

namespace App\Subscriber\Interfaces;


use Symfony\Component\Form\FormEvent;

interface ReviewImageSubscriberInterface
{
    /**
     * @param FormEvent $event
     * @return mixed
     */
    public function onSubmit(FormEvent $event);
}
