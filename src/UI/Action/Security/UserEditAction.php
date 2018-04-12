<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 13:59
 */

namespace App\UI\Action\Security;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Form\Type\EditUserType;
use App\Domain\Models\User;
use App\UI\Action\Security\Interfaces\UserEditActionInterface;
use App\UI\Form\FormHandler\Interfaces\EditUserHandlerInterface;
use App\UI\Responder\Security\Interfaces\UserEditResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserEditAction
 *
 * @Route(
 *     name="adminUserEdit",
 *     path="admin/users/edit/{id}"
 * )
 *
 * @package App\UI\Action\Security
 */
class UserEditAction implements UserEditActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

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
     * UserEditAction constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UserBuilderInterface $userBuilder
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserBuilderInterface $userBuilder,
        FormFactoryInterface $formFactory
    ) {
        $this->entityManager = $entityManager;
        $this->userBuilder = $userBuilder;
        $this->formFactory = $formFactory;
    }


    public function __invoke(Request $request, UserEditResponderInterface $responder)
    {
        $userEditType = $this->formFactory->create(EditUserType::class)->handleRequest($request);

        $user = $this->entityManager->getRepository(User::class)->showOne($request->get('id'));

        if($this->userEditTypeHandler->handle($userEditType)) {
            return $responder(true, null, $user);
        }

        return $responder(false, $userEditType, $user);
    }
}