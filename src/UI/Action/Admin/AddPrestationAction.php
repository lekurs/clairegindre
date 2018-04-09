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
use App\UI\Action\Admin\Interfaces\AddPresationActionInterface;
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
class AddPrestationAction implements AddPresationActionInterface
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
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AddPrestationAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AddBenefitTypeHandler $addBenefitTypeHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddBenefitTypeHandler $addBenefitTypeHandler,
        EntityManagerInterface $entityManager
    ) {
        $this->formFactory = $formFactory;
        $this->addBenefitTypeHandler = $addBenefitTypeHandler;
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, AddPrestationResponderInterface $responder)
    {
        $addPrestation = $this->formFactory->create(AddBenefitType::class)->handleRequest($request);

        $benefits = $this->entityManager->getRepository(Benefit::class)->getAll();

        if($this->addBenefitTypeHandler->handle($addPrestation)) {

            return $responder(true, $addPrestation, $benefits);
        }
        return $responder(false, $addPrestation, $benefits);
    }

}