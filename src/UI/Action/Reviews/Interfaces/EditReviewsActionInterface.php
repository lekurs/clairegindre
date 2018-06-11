<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 14:56
 */

namespace App\UI\Action\Reviews\Interfaces;


use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\EditReviewsTypeHandlerInterface;
use App\UI\Responder\Interfaces\EditReviewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface EditReviewsActionInterface
{
    /**
     * EditReviewsActionInterface constructor.
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     * @param FormFactoryInterface $formFactory
     * @param EditReviewsTypeHandlerInterface $editReviewsTypeHandler
     * @param ReviewsRepositoryInterface $reviewsRepository
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        FormFactoryInterface $formFactory,
        EditReviewsTypeHandlerInterface $editReviewsTypeHandler,
        ReviewsRepositoryInterface $reviewsRepository
    );

    /**
     * @param Request $request
     * @param EditReviewsResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, EditReviewsResponderInterface $responder);
}
