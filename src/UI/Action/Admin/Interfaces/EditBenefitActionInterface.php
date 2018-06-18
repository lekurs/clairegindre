<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 22:21
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\EditBenefitTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\EditBenefitResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface EditBenefitActionInterface
{
    /**
     * EditBenefitActionInterface constructor.
     * @param FormFactoryInterface $formFactory
     * @param BenefitRepositoryInterface $benefitRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     * @param EditBenefitTypeHandlerInterface $editBenefitTypeHandler
     */
    public function __construct(FormFactoryInterface $formFactory, BenefitRepositoryInterface $benefitRepository, AuthorizationCheckerInterface $authorizationChecker, TokenStorageInterface $tokenStorage, EditBenefitTypeHandlerInterface $editBenefitTypeHandler);

    /**
     * @param Request $request
     * @param EditBenefitResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, EditBenefitResponderInterface $responder);
}
