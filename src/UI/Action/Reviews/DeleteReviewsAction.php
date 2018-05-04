<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 13:47
 */

namespace App\UI\Action\Reviews;


use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Action\Reviews\Interfaces\DeleteReviewsActionInterface;
use App\UI\Responder\Interfaces\DeleteReviewsResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class DeleteReviewsAction
 *
 * @Route(
 *     name="adminDeleteReview",
 *     path="admin/reviews/del/{id}"
 * )
 *
 */
class DeleteReviewsAction implements DeleteReviewsActionInterface
{
    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * DeleteReviewsAction constructor.
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(ReviewsRepositoryInterface $reviewsRepository, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->reviewsRepository = $reviewsRepository;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function __invoke(Request $request, DeleteReviewsResponderInterface $responder)
    {
        $review = $this->reviewsRepository->getOne($request->get('id'));

        $this->reviewsRepository->delete($review);

        return $responder();
    }
}