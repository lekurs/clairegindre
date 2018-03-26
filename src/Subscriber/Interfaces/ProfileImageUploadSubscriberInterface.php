<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/03/2018
 * Time: 14:09
 */

namespace App\Subscriber\Interfaces;


use Symfony\Component\Form\FormEvent;

interface ProfileImageUploadSubscriberInterface
{
    public function onImageUpload(FormEvent $event);
}