<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 17:41
 */

namespace App\UI\Action\Security\Interfaces;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use App\UI\Responder\Security\Interfaces\RegisterResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

interface RegisterActionInterface
{

    /**
     * RegisterActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param RegistrationTypeHandlerInterface $registrationTypeHandler
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param UserBuilderInterface $userBuilder
     * @param AuthenticationErrorsResponder $errorsResponder
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $userPasswordEncoder,
        RegistrationTypeHandlerInterface $registrationTypeHandler,
        AuthorizationCheckerInterface $authorizationChecker,
        UserBuilderInterface $userBuilder,
        AuthenticationErrorsResponder $errorsResponder
    );

    /**
     * @param Request $request
     * @param RegisterResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, RegisterResponderInterface $responder);
}
