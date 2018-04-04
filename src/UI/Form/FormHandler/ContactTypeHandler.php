<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 21:39
 */

namespace App\UI\Form\FormHandler;


use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

class ContactTypeHandler implements ContactTypeHandlerInterface
{
    public function handle(FormInterface $form)
    {
        if($form->isSubmitted() && $form->isValid()) {
            //Appel de SwiftMailer

            return true;
        }
        return false;
    }

}