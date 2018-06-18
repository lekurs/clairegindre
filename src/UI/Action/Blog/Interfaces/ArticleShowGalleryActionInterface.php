<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 17:55
 */

namespace App\UI\Action\Blog\Interfaces;


use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\GalleryMakerRepository;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\Services\SlugHelper;
use App\UI\Form\FormHandler\Interfaces\AddCommentOnArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\ArticleShowGalleryResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface ArticleShowGalleryActionInterface
{
    /**
     * ArticleShowGalleryActionInterface constructor.
     *
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param PictureRepositoryInterface $pictureRepository
     * @param GalleryMakerRepository $galleryMakerRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param AddCommentOnArticleTypeHandlerInterface $addCommentHandler
     * @param InstagramLib $instagram
     * @param TokenStorageInterface $tokenStorage
     * @param SlugHelper $stringReplace
     */
    public function __construct(
        ReviewsRepositoryInterface $reviewsRepository,
        ArticleRepositoryInterface $articleRepository,
        PictureRepositoryInterface $pictureRepository,
        GalleryMakerRepository $galleryMakerRepository,
        GalleryRepositoryInterface $galleryRepository,
        FormFactoryInterface $formFactory,
        AddCommentOnArticleTypeHandlerInterface $addCommentHandler,
        InstagramLib $instagram,
        TokenStorageInterface $tokenStorage,
        SlugHelper $stringReplace
    );

    /**
     * @param Request $request
     * @param ArticleShowGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, ArticleShowGalleryResponderInterface $responder);
}
