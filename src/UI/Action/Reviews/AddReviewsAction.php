<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:02
 */

namespace App\UI\Action\Reviews;


use App\Domain\Form\Type\AddReviewsType;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Action\Reviews\Interfaces\AddReviewsActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddReviewsTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddReviewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class AddReviewsAction
 *
 * @Route(
 *     name="adminAddReviews",
 *     path="admin/reviews/add"
 * )
 *
 * @package App\UI\Action\Reviews
 */
final class AddReviewsAction implements AddReviewsActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * @var AddReviewsTypeHandlerInterface
     */
    private $addReviewsTypeHandler;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * AddReviewsAction constructor.
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
    ) {
        $this->formFactory = $formFactory;
        $this->reviewsRepository = $reviewsRepository;
        $this->addReviewsTypeHandler = $addReviewsTypeHandler;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @param AddReviewsResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddReviewsResponderInterface $responder)
    {
        if (false === $this->authorizationChecker->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('Merci de vous connecter comme Administrateur de ce site');
        }

        $reviews = $this->reviewsRepository->getAll();

        $form = $this->formFactory->create(AddReviewsType::class)->handleRequest($request);

        if($this->addReviewsTypeHandler->handle($form)) {

            return $responder(true, null, $reviews);
        }

        return $responder(false, $form, $reviews);
    }
}
