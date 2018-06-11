<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 14:58
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\ReviewsBuilderInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\EditReviewsTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class EditReviewsTypeHandler implements EditReviewsTypeHandlerInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * @var ReviewsBuilderInterface
     */
    private $reviewsBuilder;

    /**
     * EditReviewsTypeHandler constructor.
     *
     * @param SessionInterface $session
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     * @param ValidatorInterface $validator
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param ReviewsBuilderInterface $reviewsBuilder
     */
    public function __construct(
        SessionInterface $session,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        ValidatorInterface $validator,
        ReviewsRepositoryInterface $reviewsRepository,
        ReviewsBuilderInterface $reviewsBuilder
    ) {
        $this->session = $session;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
        $this->validator = $validator;
        $this->reviewsRepository = $reviewsRepository;
        $this->reviewsBuilder = $reviewsBuilder;
    }

    /**
     * @param FormInterface $form
     * @return mixed|void
     */
    public function handle(FormInterface $form):bool
    {
        if($form->isValid() && $form->isSubmitted()) {
            $review = $this->reviewsBuilder->create(
                                                                                        $form->getData()->title,
                                                                                        $form->getData()->content,
                                                                                        '',
                                                                                        $this->tokenStorage->getToken()->getUser(),
                                                                                        '',
                                                                                        '',
                                                                                        $form->getData()->online
                                                                                    );
            $this->validator->validate($review, [], [
                'reviews_creation'
            ]);

            $this->session->getFlashBag()->add('sucess', 'Avis client mis à jour');

            return true;
        }

        return false;
    }
}
