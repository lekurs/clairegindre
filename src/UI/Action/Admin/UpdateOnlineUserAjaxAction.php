<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 20:34
 */

namespace App\UI\Action\Admin;


use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Admin\Interfaces\UpdateOnlineUserAjaxActionInterface;
use App\UI\Responder\Admin\Interfaces\UpdateOnlineUserAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateOnlineUserAjaxAction
 *
 * @Route(
 *     name="adminUpdateOnlineUser",
 *     path="admin/user/update/online",
 *     methods={"POST"}
 * )
 *
 */
final class UpdateOnlineUserAjaxAction implements UpdateOnlineUserAjaxActionInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateOnlineUserAjaxAction constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @param UpdateOnlineUserAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UpdateOnlineUserAjaxResponderInterface $responder)
    {
        $user = $this->userRepository->getOneById($request->request->get('id'));

        $this->userRepository->updateOnline($user);

        return $responder();
    }
}
