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
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
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
 *     path="blog/{titleArticle}/{galleryTitle}"
 * )
 *
 * @package App\UI\Action\Blog
 */
class ArticleShowGalleryAction implements ArticleShowGalleryActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

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
     * ArticleShowGalleryAction constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param CommentRepositoryInterface $commentRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param FormFactoryInterface $formFactory
     * @param AddCommentArticleUserNotConnectedTypeHandlerInterface $addCommentHandler
     * @param InstagramLib $instagram
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository, ReviewsRepositoryInterface $reviewsRepository, CommentRepositoryInterface $commentRepository, ArticleRepositoryInterface $articleRepository, FormFactoryInterface $formFactory, AddCommentArticleUserNotConnectedTypeHandlerInterface $addCommentHandler, InstagramLib $instagram, TokenStorageInterface $tokenStorage)
    {
        $this->galleryRepository = $galleryRepository;
        $this->reviewsRepository = $reviewsRepository;
        $this->commentRepository = $commentRepository;
        $this->articleRepository = $articleRepository;
        $this->formFactory = $formFactory;
        $this->addCommentHandler = $addCommentHandler;
        $this->instagram = $instagram;
        $this->tokenStorage = $tokenStorage;
    }


    public function __invoke(Request $request, ArticleShowGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getWithPictures(strtolower(str_replace(['-', '_', '&'], [' ', '\'\'', '-'], $request->get('galleryTitle'))));

        $comments = $this->commentRepository->getAll();

        $reviews = $this->reviewsRepository->getAll();

        $article = $this->articleRepository->getOne(strtolower(str_replace(['-', '_', '&'], [' ', '\'\'', '-'], $request->get('titleArticle'))));

        $form = $this->formFactory->create(ContactType::class);

        if (!$this->tokenStorage->getToken())
        {
//            $commentType = $this->formFactory->create()->handleRequest($request);
        } else {
            $commentType = $this->formFactory->create(AddCommentArticleUserNotConnectedType::class)->handleRequest($request);
        }


        $instagram = $this->instagram->show();

        if ($this->addCommentHandler->handle($commentType, $article)) {

            return $responder(true, $form, $commentType, $gallery, $comments, $instagram, $reviews);
        }

        return $responder(false,$form, $commentType, $gallery, $comments, $instagram, $reviews);
    }

}