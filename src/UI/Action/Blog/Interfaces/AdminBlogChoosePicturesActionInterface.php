<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 12:13
 */

namespace App\UI\Action\Blog\Interfaces;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Responder\Interfaces\AdminBlogChoosePicturesResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface AdminBlogChoosePicturesActionInterface
{
    /**
     * AdminBlogChoosePicturesActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param GalleryRepositoryInterface $galleryRepository
     * @param SessionInterface|null $session
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        GalleryRepositoryInterface $galleryRepository,
        SessionInterface $session = null,
        AuthorizationCheckerInterface $authorizationChecker
    );

    /**
     * @param Request $request
     * @param AdminBlogChoosePicturesResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AdminBlogChoosePicturesResponderInterface $responder);
}
