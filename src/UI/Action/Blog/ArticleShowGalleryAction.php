<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 17:55
 */

namespace App\UI\Action\Blog;


use App\Domain\Form\Type\AddCommentArticleNotLoggedType;
use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Models\Gallery;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Action\Blog\Interfaces\ArticleShowGalleryActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddCommentArticleNotLoggedTypeHandlerInterface;
use App\UI\Responder\Interfaces\ArticleShowGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ArticleShowGalleryAction
 *
 * @Route(
 *     name="showArticle",
 *     path="blog/{idArticle}/{idGallery}"
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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddCommentArticleNotLoggedTypeHandlerInterface
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
     * @param FormFactoryInterface $formFactory
     * @param AddCommentArticleNotLoggedTypeHandlerInterface $addCommentHandler
     * @param InstagramLib $instagram
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository, ReviewsRepositoryInterface $reviewsRepository, CommentRepositoryInterface $commentRepository, FormFactoryInterface $formFactory, AddCommentArticleNotLoggedTypeHandlerInterface $addCommentHandler, InstagramLib $instagram, TokenStorageInterface $tokenStorage)
    {
        $this->galleryRepository = $galleryRepository;
        $this->reviewsRepository = $reviewsRepository;
        $this->commentRepository = $commentRepository;
        $this->formFactory = $formFactory;
        $this->addCommentHandler = $addCommentHandler;
        $this->instagram = $instagram;
        $this->tokenStorage = $tokenStorage;
    }


    public function __invoke(Request $request, ArticleShowGalleryResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getWithPictures($request->get('idGallery'));

        $comments = $this->commentRepository->getAll();

        $reviews = $this->reviewsRepository->getAll();

        $form = $this->formFactory->create(ContactType::class);

        if (!$this->tokenStorage->getToken())
        {
//            $commentType = $this->formFactory->create()->handleRequest($request);
        } else {
            $commentType = $this->formFactory->create(AddCommentArticleNotLoggedType::class)->handleRequest($request);
        }


        $instagram = $this->instagram->show();

        if ($this->addCommentHandler->handle($commentType)) {

            return $responder(true, $form, $commentType, $gallery, $comments, $instagram, $reviews);
        }

        return $responder(false,$form, $commentType, $gallery, $comments, $instagram, $reviews);
    }

}