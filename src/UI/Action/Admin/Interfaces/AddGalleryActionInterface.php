<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 06/04/2018
 * Time: 11:52
 */

namespace App\UI\Action\Admin\Interfaces;


use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AddGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddGalleryActionInterface
{
    /**
     * AddGalleryActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AddGalleryTypeHandlerInterface $galleryHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddGalleryTypeHandlerInterface $galleryHandler,
        EntityManagerInterface $entityManager
    );

    /**
     * @param Request $request
     * @param AddGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddGalleryResponderInterface $responder);
}
