<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:45
 */

namespace App\UI\Action\Front;
use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Action\Front\Interfaces\IndexActionInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\IndexResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexAction
 *
 * @Route(
 *     name="index",
 *     path="/"
 * )
 *
 * @package App\UI\Action\Index
 */
class IndexAction implements IndexActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ContactTypeHandlerInterface
     */
    private $contactTypeHandler;

    /**
     * @var InstagramLib
     */
    private $instagram;

    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * IndexAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param ContactTypeHandlerInterface $contactTypeHandler
     * @param InstagramLib $instagram
     * @param ReviewsRepositoryInterface $reviewsRepository
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ContactTypeHandlerInterface $contactTypeHandler,
        InstagramLib $instagram,
        ReviewsRepositoryInterface $reviewsRepository
    ) {
        $this->formFactory = $formFactory;
        $this->contactTypeHandler = $contactTypeHandler;
        $this->instagram = $instagram;
        $this->reviewsRepository = $reviewsRepository;
    }

    /**
     * @param Request $request
     * @param IndexResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, IndexResponderInterface $responder)
    {
        $reviews = $this->reviewsRepository->getAll();

        $instagram = $this->instagram->show();

        $contactType = $this->formFactory->create(ContactType::class)
                                                                        ->handleRequest($request);

        if($this->contactTypeHandler->handle($contactType)) {

            return $responder(true, $contactType, $instagram, $reviews);
        }

        return $responder(false, $contactType, $instagram, $reviews);
    }
}
