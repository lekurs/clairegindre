<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:21
 */

namespace App\UI\Action\Admin\Interfaces;


use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\AdminBlogResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AdminGalleryActionInterface
{
    /**
     * AdminGalleryActionInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        AddArticleTypeHandlerInterface $addArticleTypeHandler
    );

    /**
     * @param Request $request
     * @param AdminBlogResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AdminBlogResponderInterface $responder);
}
