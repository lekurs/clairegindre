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
     * @param $review
     * @return bool
     */
    public function handle(FormInterface $form, $review):bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $editReview = $review->manageReviews($form->getData());

            $this->validator->validate($editReview, [], [
                'reviews_creation'
            ]);

            $this->reviewsRepository->update();

            $this->session->getFlashBag()->add('sucess', 'Avis client mis à jour');

            return true;
        }

        return false;
    }
}
