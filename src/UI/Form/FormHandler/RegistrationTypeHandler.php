<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:57
 */

namespace App\UI\Form\FormHandler;

use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationTypeHandler implements RegistrationTypeHandlerInterface
{
    /**
     * @var UserInterface
     */
    private $userRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * RegistrationTypeHandler constructor.
     *
     * @param UserInterface $userRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param UserBuilderInterface $userBuilder
     */
    public function __construct(
        UserInterface $userRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        UserBuilderInterface $userBuilder
    ) {
        $this->userRepository = $userRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->userBuilder = $userBuilder;
    }

    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->userBuilder->create(
                                                                            $form->getData()->email,
                                                                            $form->getData()->username,
                                                                            $form->getData()->lastName,
                                                                            $form->getData()->password,
                                                                            $form->getData()->wedding_date,
                                                                            'ROLE_ADMIN'
                                                                        );

            $this->validator->validate($user, [], [
                'registration_creation'
            ]);

            $this->userRepository->save($user);

            $this->session->getFlashBag()->add('success', 'L\'utilisateur à bien été ajouté');

            return true;
        }
        return false;
    }

}