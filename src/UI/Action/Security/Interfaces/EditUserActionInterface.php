<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 13:59
 */

namespace App\UI\Action\Security\Interfaces;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\EditUserHandlerInterface;
use App\UI\Responder\Security\Interfaces\UserEditResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface EditUserActionInterface
{
    /**
     * EditUserActionInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param UserBuilderInterface $userBuilder
     * @param FormFactoryInterface $formFactory
     * @param EditUserHandlerInterface $userEditTypeHandler
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserBuilderInterface $userBuilder,
        FormFactoryInterface $formFactory,
        EditUserHandlerInterface $userEditTypeHandler,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage
    );

    /**
     * @param Request $request
     * @param UserEditResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UserEditResponderInterface $responder);
}
