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
     * EditUserAction constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserBuilderInterface $userBuilder
     * @param FormFactoryInterface $formFactory
     * @param EditUserHandlerInterface $userEditTypeHandler
     */
    public function __construct(UserRepositoryInterface $userRepository, UserBuilderInterface $userBuilder, FormFactoryInterface $formFactory, EditUserHandlerInterface $userEditTypeHandler)
    {
        $this->userRepository = $userRepository;
        $this->userBuilder = $userBuilder;
        $this->formFactory = $formFactory;
        $this->userEditTypeHandler = $userEditTypeHandler;
    }


    public function __invoke(Request $request, UserEditResponderInterface $responder)
    {
        $user = $this->userRepository->showOne($request->get('slug'));
//        dump($user->getPassword());
//        $security = new TokenStorage();
//        $security->setToken($this->token->getUser()->getPassword());
//        dump($this->token);

//        die();

        $userDto = new EditUserDTO($user->getEmail(), $user->getUsername(), $user->getLastName(), $user->getPassword(), $user->isOnline(), $user->getDateWedding(), null);

        $userEditType = $this->formFactory->create(EditUserType::class, $userDto)->handleRequest($request);


        if($this->userEditTypeHandler->handle($userEditType)) {
            return $responder(true, $userEditType, $user);
        }

        return $responder(false, $userEditType, $user);
    }
}