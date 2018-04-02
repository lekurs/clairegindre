<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 13:59
 */

namespace App\Type\Handler;


use App\Type\Handler\Interfaces\GalleryPictureOrderHandlerInterface;
use Symfony\Component\Form\FormInterface;

class GalleryPicturesOrderHandler implements GalleryPictureOrderHandlerInterface
{
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            //DOCTRINE => ORDER
        }
        return false;
    }

}