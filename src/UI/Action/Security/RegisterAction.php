<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 17:41
 */

namespace App\UI\Action\Security;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Form\Type\RegistrationType;
use App\UI\Action\Security\Interfaces\RegisterActionInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use App\UI\Responder\Security\Interfaces\RegisterResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterAction
 *
 * @Route(
 *     name="adminRegister",
 *     path="admin/register"
 * )
 *
 * @package App\UI\Action\Security
 */
class RegisterAction implements RegisterActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var RegistrationTypeHandlerInterface
     */
    private $registrationTypeHandler;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var AuthenticationErrorsResponder
     */
    private $errorResponder;

    /**
     * RegisterAction constructor.
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
    ) {
        $this->formFactory = $formFactory;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->registrationTypeHandler = $registrationTypeHandler;
        $this->authorization = $authorizationChecker;
        $this->userBuilder = $userBuilder;
        $this->errorResponder = $errorsResponder;
    }

    /**
     * @param Request $request
     * @param RegisterResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, RegisterResponderInterface $responder)
    {
//        if ($this->authorization->isGranted('ROLE_ADMIN')) {

            $registerType = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

            if($this->registrationTypeHandler->handle($registerType)) {
                return $responder(true);
            }
            return $responder(false, $registerType);
        }
//        $error = $this->errorResponder;
//
//        return $error();
//    }
}
