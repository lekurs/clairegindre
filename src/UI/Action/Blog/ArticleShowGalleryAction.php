<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 17:55
 */

namespace App\UI\Action\Blog;


use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Models\Gallery;
use App\UI\Action\Blog\Interfaces\ArticleShowGalleryActionInterface;
use App\UI\Responder\Interfaces\ArticleShowGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleShowGalleryAction
 *
 * @Route(
 *     name="showArticle",
 *     path="blog/gallery/{id}"
 * )
 *
 * @package App\UI\Action\Blog
 */
class ArticleShowGalleryAction implements ArticleShowGalleryActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var InstagramLib
     */
    private $instagram;

    /**
     * ArticleShowGalleryAction constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param InstagramLib $instagram
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        InstagramLib $instagram
    ) {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->instagram = $instagram;
    }


    public function __invoke(Request $request, ArticleShowGalleryResponderInterface $responder)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->getWithPictures($request->get('id'));

        $form = $this->formFactory->create(ContactType::class);

        $instagram = $this->instagram->show();

        return $responder(false, $form, $instagram, $gallery);
    }

}