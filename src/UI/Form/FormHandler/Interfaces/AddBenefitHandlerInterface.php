<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 21:11
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\BenefitBuilderInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddBenefitHandlerInterface
{
    /**
     * AddBenefitHandlerInterface constructor.
     *
     * @param BenefitRepositoryInterface $benefitRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param BenefitBuilderInterface $benefitBuilder
     */
    public function __construct(
        BenefitRepositoryInterface $benefitRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        BenefitBuilderInterface $benefitBuilder
    );

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form):bool;
}
