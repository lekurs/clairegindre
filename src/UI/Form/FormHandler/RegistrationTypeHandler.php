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
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationTypeHandler implements RegistrationTypeHandlerInterface
{
    /**
     * @var UserRepositoryInterface
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
     * @param UserRepositoryInterface $userRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param UserBuilderInterface $userBuilder
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
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
                                                                            $form->getData()->plainPassword,
                                                                            $form->getData()->dateWedding,
                                                                            $form->getData()->picture,
//                                                                            'ROLE_ADMIN'
                                                                        );

            $this->validator->validate($user, [], [
                'registration_creation'
            ]);
            dump($form->getData()->email);
            dump($user);
//            die();
            $this->userRepository->save($this->userBuilder->getUser());

            $this->session->getFlashBag()->add('success', 'L\'utilisateur à bien été ajouté');

            return true;
        }
        return false;
    }

}