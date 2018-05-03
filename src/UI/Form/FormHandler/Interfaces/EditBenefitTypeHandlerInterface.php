<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 22:28
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\BenefitBuilderInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface EditBenefitTypeHandlerInterface
{
    /**
     * EditBenefitTypeHandlerInterface constructor.
     *
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param BenefitRepositoryInterface $benefitRepository
     * @param BenefitBuilderInterface $benefitBuilder
     */
    public function __construct(SessionInterface $session, ValidatorInterface $validator, BenefitRepositoryInterface $benefitRepository, BenefitBuilderInterface $benefitBuilder);

    /**
     * @param FormInterface $form
     * @return mixed
     */
    public function handle(FormInterface $form);
}
