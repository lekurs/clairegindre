<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 21/06/2018
 * Time: 13:52
 */

namespace App\UI\Action\Admin;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Responder\Admin\UpdateReviewOnlineAjaxResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateReviewOnlineAjaxAction
 * @Route(
 *     name="adminUpdateOnlineReview",
 *     path="admin/reviews/add/status",
 *     methods={ "POST" }
 * )
 */
final class UpdateReviewOnlineAjaxAction
{
    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewRepository;

    /**
     * UpdateReviewOnlineAjaxAction constructor.
     * @param ReviewsRepositoryInterface $reviewRepository
     */
    public function __construct(ReviewsRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @param Request $request
     * @param UpdateReviewOnlineAjaxResponder $responder
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(Request $request, UpdateReviewOnlineAjaxResponder $responder)
    {
        $online = $this->reviewRepository->getOne($request->request->get('id'));

        $this->reviewRepository->updateOnline($online);

        return $responder();
    }
}
