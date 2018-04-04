<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:56
 */

namespace App\UI\Form\FormHandler\Interfaces;


use Symfony\Component\Form\FormInterface;

interface RegistrationTypeHandlerInterface
{
    /**
     * @param FormInterface $form
     * @return mixed
     */
    public function handle(FormInterface $form);

}