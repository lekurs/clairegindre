<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 16:51
 */

namespace App\UI\Action\Security;


use App\Domain\Form\Type\AddGalleryType;
use App\Domain\Form\Type\RegistrationType;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Security\Interfaces\UserActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class UserAction
 *
 * @Route(
 *     name="adminUser",
 *     path="admin/users/{page}",
 *     defaults={"page"=1},
 *     methods={ "GET" }
 * )
 *
 * @package App\UI\Action\Security
 */
final class UserAction implements UserActionInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddGalleryTypeHandlerInterface
     */
    private $addGalleryTypeHandler;

    /**
     * @var RegistrationTypeHandlerInterface
     */
    private $registrationTypeHandler;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * UserAction constructor.
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
    ) {
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->addGalleryTypeHandler = $addGalleryTypeHandler;
        $this->registrationTypeHandler = $registrationTypeHandler;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @param UserResponderInterface $responder
     * @param int $page
     * @return mixed
     */
    public function __invoke(Request $request, UserResponderInterface $responder, int $page)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {

            $addGalleryType = $this->formFactory->create(AddGalleryType::class);
            $registrationType = $this->formFactory->create(RegistrationType::class);

            $users= $this->userRepository->showGalleryByUserWithPagination($page, 5);

            $pagination = [
                'page' => $page,
                'nbPages' => ceil(count($users) / 5)
            ];

            if ($this->addGalleryTypeHandler->handle($addGalleryType, $users)) {

                return $responder(true, null, null, $users, $pagination);
            }

            if ($this->registrationTypeHandler->handle($registrationType)) {

                return $responder(true, null, null, $users, $pagination);
            }

            return $responder(false, $addGalleryType, $registrationType, $users, $pagination);
        }
    }
}
