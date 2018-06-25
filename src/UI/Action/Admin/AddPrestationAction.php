<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 09/04/2018
 * Time: 12:18
 */

namespace App\UI\Action\Admin;

use App\Domain\Form\Type\AddBenefitType;
use App\Domain\Models\Benefit;
use App\Domain\Repository\BenefitRepository;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\UI\Action\Admin\Interfaces\AddPrestationActionInterface;
use App\UI\Form\FormHandler\AddBenefitTypeHandler;
use App\UI\Responder\Admin\Interfaces\AddPrestationResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class AddPrestationAction
 *
 * @Route(
 *     name="adminBenefit",
 *     path="admin/configuration/benefit"
 * )
 *
 * @package App\UI\Action\Admin
 */
final class AddPrestationAction implements AddPrestationActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddBenefitTypeHandler
     */
    private $addBenefitTypeHandler;

    /**
     * @var BenefitRepositoryInterface
     */
    private $benefitRepository;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var AuthenticationErrorsResponder
     */
    private $errorResponder;

    /**
     * AddPrestationAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AddBenefitTypeHandler $addBenefitTypeHandler
     * @param BenefitRepositoryInterface $benefitRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param AuthenticationErrorsResponder $errorResponder
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddBenefitTypeHandler $addBenefitTypeHandler,
        BenefitRepositoryInterface $benefitRepository,
        AuthorizationCheckerInterface $authorizationChecker,
        AuthenticationErrorsResponder $errorResponder
    ) {
        $this->formFactory = $formFactory;
        $this->addBenefitTypeHandler = $addBenefitTypeHandler;
        $this->benefitRepository = $benefitRepository;
        $this->authorizationChecker = $authorizationChecker;
        $this->errorResponder = $errorResponder;
    }

    /**
     * @param Request $request
     * @param AddPrestationResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddPrestationResponderInterface $responder)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $addPrestation = $this->formFactory->create(AddBenefitType::class)->handleRequest($request);

            $benefits = $this->benefitRepository->getAll();

            if($this->addBenefitTypeHandler->handle($addPrestation)) {

                return $responder(true, $addPrestation, $benefits);
            }
            return $responder(false, $addPrestation, $benefits);
        } else {
            $error = $this->errorResponder;

            return $error();
        }
    }
}
