<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 14:58
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\ReviewsBuilderInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface EditReviewsTypeHandlerInterface
{
    /**
     * EditReviewsTypeHandlerInterface constructor.
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
    );

    /**
     * @param FormInterface $form
     * @return mixed
     */
    public function handle(FormInterface $form);
}
