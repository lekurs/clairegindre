<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 21/06/2018
 * Time: 15:18
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface MarkMailAsReadTypeHandlerInterface
{
    /**
     * MarkMailAsReadTypeHandlerInterface constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     */
    public function __construct(MailRepositoryInterface $mailRepository);

    /**
     * @param FormInterface $form
     * @param $email
     * @return bool
     */
    public function handle(FormInterface $form, $email): bool;
}
