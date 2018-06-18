<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 16:57
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\UI\Responder\Admin\Interfaces\ListMailResponderInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface ListMailActionInterface
{
    /**
     * ListMailActionInterface constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param ListMailResponderInterface $responder
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        ListMailResponderInterface $responder,
        AuthorizationCheckerInterface $authorizationChecker
    );

    /**
     * @return mixed
     */
    public function __invoke();
}
