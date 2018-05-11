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
use App\Services\StringReplaceUrlHelper;
use App\UI\Form\FormHandler\Interfaces\EditUserHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @var StringReplaceUrlHelper
     */
    private $stringReplaceHelper;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * EditUserHandler constructor.
     * @param UserRepositoryInterface $userRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param UserBuilderInterface $userBuilder
     * @param StringReplaceUrlHelper $stringReplaceHelper
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(UserRepositoryInterface $userRepository, SessionInterface $session, ValidatorInterface $validator, UserBuilderInterface $userBuilder, StringReplaceUrlHelper $stringReplaceHelper, TokenStorageInterface $tokenStorage)
    {
        $this->userRepository = $userRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->userBuilder = $userBuilder;
        $this->stringReplaceHelper = $stringReplaceHelper;
        $this->tokenStorage = $tokenStorage;
    }


    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            dump($this->tokenStorage->getToken()->getUser()->getPassword());

            $user = $this->userRepository->getOne($this->stringReplaceHelper->replace($form->getData()->username . '-' . $form->getData()->lastName));

            if(is_null($form->getData()->plainPassword)) {
                $password = $this->tokenStorage->getToken()->getUser()->getPassword();
                dump('toto');
            } else {
                    dump('tata');
                    $password = $form->getData()->plainPassword;
                }

                $picture = $user->getPicture();

            $user = $this->userBuilder->create(
                                                                $form->getData()->email,
                                                                $form->getData()->username,
                                                                $form->getData()->lastName,
                                                                $password,
//                                                                $form->getData()->plainPassword,
                                                                $form->getData()->weddingDate,
                                                                $picture,
                                                                $form->getData()->online, 'ROLE_USER',
                                                                $this->stringReplaceHelper->replace($form->getData()->username . '-' . $form->getData()->lastName)
                                                            );

            $this->validator->validate($user, [

            ]);

            $this->session->getFlashBag()->add('success', 'Utilisateur mis à jour');

            $this->userRepository->update($this->userBuilder->getUser());

            return true;
        }
        return false;
    }
}
