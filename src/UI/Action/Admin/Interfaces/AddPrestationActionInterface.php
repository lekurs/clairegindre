<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 09/04/2018
 * Time: 12:18
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\UI\Form\FormHandler\AddBenefitTypeHandler;
use App\UI\Responder\Admin\Interfaces\AddPrestationResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface AddPrestationActionInterface
{
    /**
     * AddPrestationActionInterface constructor.
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
    );

    /**
     * @param Request $request
     * @param AddPrestationResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddPrestationResponderInterface $responder);
}