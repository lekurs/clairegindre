<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 14:56
 */

namespace App\UI\Action\Reviews;


use App\Domain\DTO\EditReviewsDTO;
use App\Domain\Form\Type\EditReviewType;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Action\Reviews\Interfaces\EditReviewsActionInterface;
use App\UI\Form\FormHandler\Interfaces\EditReviewsTypeHandlerInterface;
use App\UI\Responder\Interfaces\EditReviewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class EditReviewsAction
 *
 * @Route(
 *     name="adminEditReview",
 *     path="admin/reviews/edit/{id}"
 * )
 *
 */
final class EditReviewsAction implements EditReviewsActionInterface
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EditReviewsTypeHandlerInterface
     */
    private $editReviewsTypeHandler;

    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * EditReviewsAction constructor.
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
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
        $this->formFactory = $formFactory;
        $this->editReviewsTypeHandler = $editReviewsTypeHandler;
        $this->reviewsRepository = $reviewsRepository;
    }

    /**
     * @param Request $request
     * @param EditReviewsResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, EditReviewsResponderInterface $responder)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $review = $this->reviewsRepository->getOne($request->get('id'));

            $reviewDTO = new EditReviewsDTO($review->getTitle(), $review->getContent(), $review->isOnline(), $review->getImageName());

            $editReviewType = $this->formFactory->create(EditReviewType::class, $reviewDTO);

//        if ($this->editReviewsTypeHandler)

            return $responder(false, $editReviewType);
        }
    }
}
