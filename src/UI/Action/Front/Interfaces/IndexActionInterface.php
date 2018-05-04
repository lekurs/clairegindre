<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:45
 */

namespace App\UI\Action\Front\Interfaces;


use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\IndexResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface IndexActionInterface
{
    /**
     * IndexActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param ContactTypeHandlerInterface $contactTypeHandler
     * @param InstagramLib $instagram
     * @param ReviewsRepositoryInterface $reviewsRepository
     */
    public function __construct(FormFactoryInterface $formFactory, ContactTypeHandlerInterface $contactTypeHandler, InstagramLib $instagram, ReviewsRepositoryInterface $reviewsRepository);

    /**
     * @param Request $request
     * @param IndexResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, IndexResponderInterface $responder);

}