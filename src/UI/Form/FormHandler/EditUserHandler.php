<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 14:16
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\EditUserHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EditUserHandler implements EditUserHandlerInterface
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
     * EditUserHandler constructor.
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
    )
    {
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
                                                                $form->getData()->weddingDate,
                                                                $form->getData()->picture,
                                                                $form->getData()->online, 'ROLE_USER'
                                                            );

            $this->validator->validate($user, [

            ]);

            $this->session->getFlashBag()->add('success', 'Utilisateur mis à jour');

            $this->userRepository->save($this->userBuilder->getUser());

            return true;
        }
        return false;
    }
}
