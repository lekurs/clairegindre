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
use App\Services\SlugHelper;
use App\UI\Form\FormHandler\Interfaces\EditUserHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class EditUserHandler implements EditUserHandlerInterface
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
     * @var SlugHelper
     */
    private $stringReplaceHelper;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * EditUserHandler constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param UserBuilderInterface $userBuilder
     * @param SlugHelper $stringReplaceHelper
     * @param TokenStorageInterface $tokenStorage
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        UserBuilderInterface $userBuilder,
        SlugHelper $stringReplaceHelper,
        TokenStorageInterface $tokenStorage,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->userRepository = $userRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->userBuilder = $userBuilder;
        $this->stringReplaceHelper = $stringReplaceHelper;
        $this->tokenStorage = $tokenStorage;
        $this->encoder = $encoder;
    }

    /**
     * @param FormInterface $form
     * @param $user
     * @return bool
     */
    public function handle(FormInterface $form, $user): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            if(is_null($form->getData()->plainPassword)) {
                $form->getData()->plainPassword = $this->tokenStorage->getToken()->getUser()->getPassword();
            } else {
                $form->getData()->plainPassword = $this->encoder->encodePassword($user, $form->getData()->plainPassword);
                }

            $user->updateUser($form->getData());

            $this->validator->validate($user, [], [
                'user_creation'
            ]);

            $this->session->getFlashBag()->add('success', 'Utilisateur mis à jour');

            $this->userRepository->update();

            return true;
        }
        return false;
    }
}
