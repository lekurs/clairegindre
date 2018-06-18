<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 16:57
 */

namespace App\UI\Action\Admin;


use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\UI\Action\Admin\Interfaces\ListMailActionInterface;
use App\UI\Responder\Admin\Interfaces\ListMailResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class ListMailAction
 *
 * @Route(
 *     name="admin_mails",
 *     path="admin/mails",
 *     methods={"GET"}
 * )
 *
 */
final class ListMailAction implements ListMailActionInterface
{
    /**
     * @var MailRepositoryInterface
     */
    private $mailRepository;

    /**
     * @var ListMailResponderInterface
     */
    private $responder;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * ListMailAction constructor.
     *
     * @param MailRepositoryInterface $mailRepository
     * @param ListMailResponderInterface $responder
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        MailRepositoryInterface $mailRepository,
        ListMailResponderInterface $responder,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->mailRepository = $mailRepository;
        $this->responder = $responder;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN'))
        {
            $mails = $this->mailRepository->getAll();

            $responder = $this->responder;

            return $responder($mails);
        }
    }
}
