<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 17:55
 */

namespace App\UI\Action\Blog;


use App\Domain\Form\Type\AddCommentArticleUserNotConnectedType;
use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\ArticleRepository;
use App\Domain\Repository\GalleryMakerRepository;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\Services\SlugHelper;
use App\UI\Action\Blog\Interfaces\ArticleShowGalleryActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddCommentArticleUserNotConnectedTypeHandlerInterface;
use App\UI\Responder\Interfaces\ArticleShowGalleryResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ArticleShowGalleryAction
 *
 * @Route(
 *     name="showArticle",
 *     path="blog/{slugArticle}/{slugGallery}"
 * )
 *
 * @package App\UI\Action\Blog
 */
class ArticleShowGalleryAction implements ArticleShowGalleryActionInterface
{
    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var GalleryMakerRepository
     */
    private $galleryMakerRepository;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddCommentArticleUserNotConnectedTypeHandlerInterface
     */
    private $addCommentHandler;

    /**
     * @var InstagramLib
     */
    private $instagram;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SlugHelper
     */
    private $stringReplace;

    /**
     * ArticleShowGalleryAction constructor.
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param GalleryMakerRepository $galleryMakerRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param AddCommentArticleUserNotConnectedTypeHandlerInterface $addCommentHandler
     * @param InstagramLib $instagram
     * @param TokenStorageInterface $tokenStorage
     * @param SlugHelper $stringReplace
     */
    public function __construct(ReviewsRepositoryInterface $reviewsRepository, ArticleRepositoryInterface $articleRepository, GalleryMakerRepository $galleryMakerRepository, GalleryRepositoryInterface $galleryRepository, FormFactoryInterface $formFactory, AddCommentArticleUserNotConnectedTypeHandlerInterface $addCommentHandler, InstagramLib $instagram, TokenStorageInterface $tokenStorage, SlugHelper $stringReplace)
    {
        $this->reviewsRepository = $reviewsRepository;
        $this->articleRepository = $articleRepository;
        $this->galleryMakerRepository = $galleryMakerRepository;
        $this->galleryRepository = $galleryRepository;
        $this->formFactory = $formFactory;
        $this->addCommentHandler = $addCommentHandler;
        $this->instagram = $instagram;
        $this->tokenStorage = $tokenStorage;
        $this->stringReplace = $stringReplace;
    }


    public function __invoke(Request $request, ArticleShowGalleryResponderInterface $responder)
    {
        $reviews = $this->reviewsRepository->getAll();

        $article = $this->articleRepository->getOne($request->get('slugArticle'));

//        $galleryMaker = $this->galleryMakerRepository->getByArticle($article->getid());

        $gallerys = $this->galleryRepository->getOne($request->attributes->get('slugGallery'));

//        dump($gallerys);
//        die;
        $data[] = array();

        $gallerys = $this->galleryRepository->getOne($request->attributes->get('slugGallery'));

        $data[] = array();

        foreach($gallerys->getPictures() as $key => $images) {
            $data[$images->getGalleryMaker()->getLine()][$images->getGalleryMaker()->getDisplayOrder()][] = $images->getPublicPath() . '/' . $images->getPictureName();
        }

//        dump($data);

        $form = $this->formFactory->create(ContactType::class);

        if (!$this->tokenStorage->getToken())
        {
//            $commentType = $this->formFactory->create()->handleRequest($request);
        } else {
            $commentType = $this->formFactory->create(AddCommentArticleUserNotConnectedType::class)->handleRequest($request);
        }


        $instagram = $this->instagram->show();

        if ($this->addCommentHandler->handle($commentType, $article)) {

            return $responder(true, $form, $commentType, $article, $data, $instagram, $reviews);
        }

        return $responder(false,$form, $commentType, $article, $data, $instagram, $reviews);
    }

}