<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 21:39
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\SlugHelperInterface;
use App\Services\MailerHelper;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

interface ContactTypeHandlerInterface
{
    /**
     * ContactTypeHandlerInterface constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param UserRepositoryInterface $userRepository
     * @param MailerHelper $mailerHelper
     * @param SlugHelperInterface $slugHelper
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param Environment $twig
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        UserRepositoryInterface $userRepository,
        MailerHelper $mailerHelper,
        SlugHelperInterface $slugHelper,
        ValidatorInterface $validator,
        SessionInterface $session,
        Environment $twig
    );

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form):bool;
}