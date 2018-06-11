<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:20
 */

namespace App\UI\Action\Blog;

use App\Domain\Form\Type\AddArticleType;
use App\Domain\Models\Article;
use App\Domain\Models\Gallery;
use App\Domain\Repository\ArticleRepository;
use App\UI\Action\Admin\Interfaces\AdminGalleryActionInterface;
use App\UI\Action\Blog\Interfaces\AdminBlogActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\AdminBlogResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminBlogAction
 *
 * @Route(
 *     name="adminBlog",
 *     path="admin/blog"
 * )
 *
 * @package App\UI\Action\Blog
 */
final class AdminBlogAction implements AdminBlogActionInterface
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
     * @var AddArticleTypeHandlerInterface
     */
    private $addArticleTypeHandler;

    /**
     * AdminBlogAction constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        AddArticleTypeHandlerInterface $addArticleTypeHandler
    ) {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->addArticleTypeHandler = $addArticleTypeHandler;
    }

    /**
     * @param Request $request
     * @param AdminBlogResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AdminBlogResponderInterface $responder)
    {
        $categories = $this->entityManager->getRepository(Article::class)->findAll();

        $this->entityManager->getRepository(Gallery::class)->getGalleryWithoutArticle();

        $form = $this->formFactory->create(AddArticleType::class)->handleRequest($request);

        if ($this->addArticleTypeHandler->handle($form)) {
            return $responder(false, $form, $categories);
        }

        return $responder(false, $form, $categories);
    }
}
