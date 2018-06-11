<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 22:28
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\BenefitBuilderInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\EditBenefitTypeHandlerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class EditBenefitTypeHandler implements EditBenefitTypeHandlerInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var BenefitRepositoryInterface
     */
    private $benefitRepository;

    /**
     * @var BenefitBuilderInterface
     */
    private $benefitBuilder;

    /**
     * EditBenefitTypeHandler constructor.
     *
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param BenefitRepositoryInterface $benefitRepository
     * @param BenefitBuilderInterface $benefitBuilder
     */
    public function __construct(
        SessionInterface $session,
        ValidatorInterface $validator,
        BenefitRepositoryInterface $benefitRepository,
        BenefitBuilderInterface $benefitBuilder
    ) {
        $this->session = $session;
        $this->validator = $validator;
        $this->benefitRepository = $benefitRepository;
        $this->benefitBuilder = $benefitBuilder;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form):bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $benefit = $this->benefitBuilder->create(
                                                                                        $form->getData()->name
                                                                                    );
            $this->validator->validate($benefit, [], [
                'benefit_creation'
            ]);

            $this->benefitRepository->edit($benefit->getBenefit());

            $this->session->getFlashBag()->add('success', 'La prestation à été modifiée');

            return true;
        }

        return false;
    }
}
