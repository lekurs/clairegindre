<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 21:11
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\BenefitBuilderInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddBenefitHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddBenefitTypeHandler implements AddBenefitHandlerInterface
{
    /**
     * @var BenefitRepositoryInterface
     */
    private $benefitRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var BenefitBuilderInterface
     */
    private $benefitBuilder;

    /**
     * AddBenefitTypeHandler constructor.
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
    ) {
        $this->benefitRepository = $benefitRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->benefitBuilder = $benefitBuilder;
    }

    public function handle(FormInterface $form):bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $benefit = $this->benefitBuilder->create($form->getData()->name);

            $this->validator->validate($benefit, [], [
                'benefit_creation',
                ]);

            $this->benefitRepository->save($this->benefitBuilder->getBenefit());

            $this->session->getFlashBag()->add('success', 'Une nouvelle prestation à été ajoutée');

            return true;
        }
        return false;
    }
}
