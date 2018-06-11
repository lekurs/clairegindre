<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 13:47
 */

namespace App\UI\Action\Reviews\Interfaces;


use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Responder\Interfaces\DeleteReviewsResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface DeleteReviewsActionInterface
{
    /**
     * DeleteReviewsActionInterface constructor.
     *
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(ReviewsRepositoryInterface $reviewsRepository, AuthorizationCheckerInterface $authorizationChecker);

    /**
     * @param Request $request
     * @param DeleteReviewsResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteReviewsResponderInterface $responder);
}
