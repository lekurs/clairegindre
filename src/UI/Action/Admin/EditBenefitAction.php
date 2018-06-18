<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 22:20
 */

namespace App\UI\Action\Admin;


use App\Domain\DTO\EditBenefitDTO;
use App\Domain\Form\Type\EditBenefitType;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\UI\Action\Admin\Interfaces\EditBenefitActionInterface;
use App\UI\Form\FormHandler\Interfaces\EditBenefitTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\EditBenefitResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class EditBenefitAction
 *
 * @Route(
 *     name="adminEditBenefit",
 *     path="admin/benefit/edit/{id}"
 * )
 *
 */
final class EditBenefitAction implements EditBenefitActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var BenefitRepositoryInterface
     */
    private $benefitRepository;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var EditBenefitTypeHandlerInterface
     */
    private $editBenefitTypeHandler;

    /**
     * EditBenefitAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param BenefitRepositoryInterface $benefitRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     * @param EditBenefitTypeHandlerInterface $editBenefitTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        BenefitRepositoryInterface $benefitRepository,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        EditBenefitTypeHandlerInterface $editBenefitTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->benefitRepository = $benefitRepository;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
        $this->editBenefitTypeHandler = $editBenefitTypeHandler;
    }

    /**
     * @param Request $request
     * @param EditBenefitResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, EditBenefitResponderInterface $responder)
    {
        if (false === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Merci de vous connecter en Administrateur');
        }

        $benefit = $this->benefitRepository->getOne($request->attributes->get('id'));

        $benefitDTO = new EditBenefitDTO($benefit->getName());

        $editBenefitType = $this->formFactory->create(EditBenefitType::class, $benefitDTO)->handleRequest($request);

        if ($this->editBenefitTypeHandler->handle($editBenefitType)) {

            return $responder(true, $editBenefitType, $benefit);
        }

        return $responder(false, $editBenefitType, $benefit);
    }
}
