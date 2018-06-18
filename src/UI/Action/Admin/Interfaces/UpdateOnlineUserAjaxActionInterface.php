<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 20:34
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Admin\Interfaces\UpdateOnlineUserAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface UpdateOnlineUserAjaxActionInterface
{
    /**
     * UpdateOnlineUserAjaxActionInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository);

    /**
     * @param Request $request
     * @param UpdateOnlineUserAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UpdateOnlineUserAjaxResponderInterface $responder);
}
