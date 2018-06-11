<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:02
 */

namespace App\UI\Action\Reviews\Interfaces;


use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddReviewsTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddReviewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface AddReviewsActionInterface
{
    /**
     * AddReviewsActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param AddReviewsTypeHandlerInterface $addReviewsTypeHandler
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ReviewsRepositoryInterface $reviewsRepository,
        AddReviewsTypeHandlerInterface $addReviewsTypeHandler,
        AuthorizationCheckerInterface $authorizationChecker
    );
    /**
     * @param Request $request
     * @param AddReviewsResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddReviewsResponderInterface $responder);
}
