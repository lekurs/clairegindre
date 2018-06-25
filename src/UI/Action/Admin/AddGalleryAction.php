<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 06/04/2018
 * Time: 11:52
 */

namespace App\UI\Action\Admin;


use App\Domain\Form\Type\AddGalleryType;
use App\Domain\Models\User;
use App\UI\Action\Admin\Interfaces\AddGalleryActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AddGalleryResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class AddGalleryAction
 *
 * @Route(
 *     name="adminAddGallery",
 *     path="admin/users/{page}",
 *     defaults={"page"=1},
 *     methods={"POST"}
 * )
 *
 * @package App\UI\Action\Admin
 */
final class AddGalleryAction implements AddGalleryActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddGalleryTypeHandlerInterface
     */
    private $galleryHandler;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var AuthenticationErrorsResponder
     */
    private $authentificationError;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * AddGalleryAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AddGalleryTypeHandlerInterface $galleryHandler
     * @param EntityManagerInterface $entityManager
     * @param AuthenticationErrorsResponder $errorsResponder
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddGalleryTypeHandlerInterface $galleryHandler,
        EntityManagerInterface $entityManager,
        AuthenticationErrorsResponder $errorsResponder,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->formFactory = $formFactory;
        $this->galleryHandler = $galleryHandler;
        $this->entityManager = $entityManager;
        $this->authentificationError = $errorsResponder;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @param AddGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddGalleryResponderInterface $responder)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {

            $form = $this->formFactory->create(AddGalleryType::class)->handleRequest($request);

            $user = $this->entityManager->getRepository(User::class)->find($request->request->get('add_gallery')['user']);

            if ($this->galleryHandler->handle($form, $user)) {

                return $responder(true, $form, $user);
            }

            return $responder(false, $user);
        } else {

            $error = $this->authentificationError;

            return $error();
        }
    }
}
