<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 13:59
 */

namespace App\UI\Action\Security;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\DTO\EditUserDTO;
use App\Domain\Form\Type\EditUserType;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Security\Interfaces\EditUserActionInterface;
use App\UI\Form\FormHandler\Interfaces\EditUserHandlerInterface;
use App\UI\Responder\Security\Interfaces\UserEditResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class EditUserAction
 *
 * @Route(
 *     name="adminUserEdit",
 *     path="admin/users/edit/{slug}"
 * )
 *
 * @package App\UI\Action\Security
 */
class EditUserAction implements EditUserActionInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EditUserHandlerInterface
     */
    private $userEditTypeHandler;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * EditUserAction constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param UserBuilderInterface $userBuilder
     * @param FormFactoryInterface $formFactory
     * @param EditUserHandlerInterface $userEditTypeHandler
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserBuilderInterface $userBuilder,
        FormFactoryInterface $formFactory,
        EditUserHandlerInterface $userEditTypeHandler,
        TokenStorageInterface $tokenStorage
    ) {
        $this->userRepository = $userRepository;
        $this->userBuilder = $userBuilder;
        $this->formFactory = $formFactory;
        $this->userEditTypeHandler = $userEditTypeHandler;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     * @param UserEditResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UserEditResponderInterface $responder)
    {
        $user = $this->userRepository->getOne($request->attributes->get('slug'));
//        dump($user->getPassword());$this->tokenStorage->setToken();
//        dump($this->tokenStorage->getToken()->getUser()->getPassword());

//        die();

        $userDto = new EditUserDTO($user->getEmail(), $user->getUsername(), $user->getLastName(), $user->getPassword(), $user->isOnline(), $user->getDateWedding(), $user->getSlug());

        $userEditType = $this->formFactory->create(EditUserType::class, $userDto)->handleRequest($request);

        if($this->userEditTypeHandler->handle($userEditType, $user)) {

            return $responder(true, $userEditType, $user);
        }

        return $responder(false, $userEditType, $user);
    }
}