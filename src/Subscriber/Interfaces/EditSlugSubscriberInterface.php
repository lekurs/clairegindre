<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/06/2018
 * Time: 11:34
 */

namespace App\Subscriber\Interfaces;


use App\Services\SlugHelper;
use Symfony\Component\Form\FormEvent;

interface EditSlugSubscriberInterface
{
    /**
     * EditSlugSubscriberInterface constructor.
     *
     * @param SlugHelper $slugHelper
     */
    public function __construct(SlugHelper $slugHelper);

    /**
     * @param FormEvent $event
     * @return mixed
     */
    public function onSubmit(FormEvent $event);
}