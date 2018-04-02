<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:19
 */

namespace App\UI\Form\FormHandler\Interfaces;


use Symfony\Component\Form\FormInterface;

interface AddArticleTypeHandlerInterface
{
    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
