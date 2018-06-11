<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:18
 */

namespace App\UI\Action\Blog\Interfaces;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddArticleResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface AddArticleActionInterface
{
    /**
     * AddArticleActionInterface constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        FormFactoryInterface $formFactory,
        AddArticleTypeHandlerInterface $addArticleTypeHandler,
        AuthorizationCheckerInterface $authorizationChecker
    );

    /**
     * @param Request $request
     * @param AddArticleResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddArticleResponderInterface $responder);
}
