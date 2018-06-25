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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * AddPrestationAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AddBenefitTypeHandler $addBenefitTypeHandler
     * @param BenefitRepositoryInterface $benefitRepository
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddBenefitTypeHandler $addBenefitTypeHandler,
        BenefitRepositoryInterface $benefitRepository
    ) {
        $this->formFactory = $formFactory;
        $this->addBenefitTypeHandler = $addBenefitTypeHandler;
        $this->benefitRepository = $benefitRepository;
    }

    /**
     * @param Request $request
     * @param AddPrestationResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddPrestationResponderInterface $responder)
    {
        $addPrestation = $this->formFactory->create(AddBenefitType::class)->handleRequest($request);

        $benefits = $this->benefitRepository->getAll();

        if($this->addBenefitTypeHandler->handle($addPrestation)) {

            return $responder(true, $addPrestation, $benefits);
        }
        return $responder(false, $addPrestation, $benefits);
    }
}
