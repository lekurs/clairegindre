<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 31/05/2018
 * Time: 14:42
 */

namespace App\Subscriber\Interfaces;


use App\Services\SlugHelper;
use Symfony\Component\Form\FormEvent;

interface EditUserSlugSubscriberInterface
{
    /**
     * EditUserSlugSubscriberInterface constructor.
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
