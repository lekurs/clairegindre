<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:02
 */

namespace App\UI\Action\Reviews;


use App\Domain\Builder\Interfaces\ReviewsBuilderInterface;
use App\Domain\Form\Type\AddReviewsType;
use App\UI\Action\Reviews\Interfaces\AddReviewsActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddReviewsTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddReviewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
class AddReviewsAction implements AddReviewsActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ReviewsBuilderInterface
     */
    private $reviewsBuilder;

    /**
     * @var AddReviewsTypeHandlerInterface
     */
    private $addReviewsTypeHandler;

    /**
     * AddReviewsAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param ReviewsBuilderInterface $reviewsBuilder
     * @param AddReviewsTypeHandlerInterface $addReviewsTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ReviewsBuilderInterface $reviewsBuilder,
        AddReviewsTypeHandlerInterface $addReviewsTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->reviewsBuilder = $reviewsBuilder;
        $this->addReviewsTypeHandler = $addReviewsTypeHandler;
    }

    public function __invoke(Request $request, AddReviewsResponderInterface $responder)
    {
        $form = $this->formFactory->create(AddReviewsType::class)->handleRequest($request);

        if($this->addReviewsTypeHandler->handle($form)) {
            return $responder(true, null);
        }

        return $responder(false, $form);
    }
}