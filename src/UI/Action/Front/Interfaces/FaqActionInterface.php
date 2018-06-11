<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 02/05/2018
 * Time: 10:33
 */

namespace App\UI\Action\Front\Interfaces;


use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\FaqResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface FaqActionInterface
{
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
    );

    /**
     * @param Request $request
     * @param FaqResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, FaqResponderInterface $responder);
}
