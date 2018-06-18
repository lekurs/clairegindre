<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 16:50
 */

namespace App\UI\Action\Security\Interfaces;


use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface UserActionInterface
{
    /**
     * UserActionInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param FormFactoryInterface $formFactory
     * @param AddGalleryTypeHandlerInterface $addGalleryTypeHandler
     * @param RegistrationTypeHandlerInterface $registrationTypeHandler
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        FormFactoryInterface $formFactory,
        AddGalleryTypeHandlerInterface $addGalleryTypeHandler,
        RegistrationTypeHandlerInterface $registrationTypeHandler,
        AuthorizationCheckerInterface $authorizationChecker
    );

    /**
     * @param Request $request
     * @param UserResponderInterface $responder
     * @param int $page
     * @return mixed
     */
    public function __invoke(Request $request, UserResponderInterface $responder, int $page);
}