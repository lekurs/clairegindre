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
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Security\Interfaces\RegisterResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
class RegisterAction
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
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * RegisterAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param RegistrationTypeHandlerInterface $registrationTypeHandler
     * @param UserBuilderInterface $userBuilder
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $userPasswordEncoder,
        RegistrationTypeHandlerInterface $registrationTypeHandler,
        UserBuilderInterface $userBuilder
    )
    {
        $this->formFactory = $formFactory;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->registrationTypeHandler = $registrationTypeHandler;
        $this->userBuilder = $userBuilder;
    }


    public function __invoke(Request $request, RegisterResponderInterface $responder)
    {
        $registerType = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

        if($this->registrationTypeHandler->handle($registerType)) {
            return $responder(true);
        }
        return $responder(false, $registerType);
    }

}