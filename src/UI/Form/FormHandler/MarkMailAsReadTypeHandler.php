<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 21/06/2018
 * Time: 15:15
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\MarkMailAsReadTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

final class MarkMailAsReadTypeHandler implements MarkMailAsReadTypeHandlerInterface
{
    /**
     * @var MailRepositoryInterface
     */
    private $mailRepository;

    /**
     * MarkMailAsReadTypeHandler constructor.
     * @param MailRepositoryInterface $mailRepository
     */
    public function __construct(MailRepositoryInterface $mailRepository)
    {
        $this->mailRepository = $mailRepository;
    }

    /**
     * @param FormInterface $form
     * @param $email
     * @return bool
     */
    public function handle(FormInterface $form, $email): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $mark = $email->mailRead();

            $this->mailRepository->update($mark);

            return true;
        }

        return false;
    }
}
