<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/06/2018
 * Time: 12:38
 */

namespace App\UI\Action\Front\Interfaces;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\GalleryCustomerResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface GalleryCustomerActionInterface
{
    /**
     * GalleryCustomerActionInterface constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param ContactTypeHandlerInterface $contactTypeHandler
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        FormFactoryInterface $formFactory,
        ContactTypeHandlerInterface $contactTypeHandler
    );

    /**
     * @param Request $request
     * @param GalleryCustomerResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, GalleryCustomerResponderInterface $responder);
}
