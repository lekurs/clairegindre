<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 02/05/2018
 * Time: 10:33
 */

namespace App\UI\Action\Front;


use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Action\Front\Interfaces\FaqActionInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\FaqResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FaqAction
 *
 * @Route(
 *     name="faq",
 *     path="faq"
 * )
 *
 */
final class FaqAction implements FaqActionInterface
{
    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * @var ContactTypeHandlerInterface
     */
    private $contactTypeHandler;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var InstagramLib
     */
    private $instagramLib;

    /**
     * FaqAction constructor.
     *
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param ContactTypeHandlerInterface $contactTypeHandler
     * @param FormFactoryInterface $formFactory
     * @param InstagramLib $instagramLib
     */
    public function __construct(
        ReviewsRepositoryInterface $reviewsRepository,
        ContactTypeHandlerInterface $contactTypeHandler,
        FormFactoryInterface $formFactory,
        InstagramLib $instagramLib
    ) {
        $this->reviewsRepository = $reviewsRepository;
        $this->contactTypeHandler = $contactTypeHandler;
        $this->formFactory = $formFactory;
        $this->instagramLib = $instagramLib;
    }


    /**
     * @param Request $request
     * @param FaqResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, FaqResponderInterface $responder)
    {
        $reviews = $this->reviewsRepository->getAll();

        $contactType = $this->formFactory->create(ContactType::class)->handleRequest($request);

        if($this->contactTypeHandler->handle($contactType)) {

            return $responder(true, $contactType, $reviews, $this->instagramLib->show());
        }

        return $responder(false, $contactType, $reviews, $this->instagramLib->show());
    }
}
