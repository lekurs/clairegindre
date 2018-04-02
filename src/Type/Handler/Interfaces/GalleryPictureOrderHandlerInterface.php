<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 14:00
 */

namespace App\Type\Handler\Interfaces;


use Symfony\Component\Form\FormInterface;

interface GalleryPictureOrderHandlerInterface
{
    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form):bool;
}