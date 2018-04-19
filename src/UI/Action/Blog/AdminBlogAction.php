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
use App\Domain\Repository\ArticleRepository;
use App\UI\Action\Admin\Interfaces\AdminGalleryActionInterface;
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
class AdminBlogAction implements AdminGalleryActionInterface
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


    public function __invoke(Request $request, AdminBlogResponderInterface $responder)
    {
        $categories = $this->entityManager->getRepository(Article::class)->findAll();

        $form = $this->formFactory->create(AddArticleType::class)->handleRequest($request);

        if($this->addArticleTypeHandler->handle($form)) {
            return $responder(false, null, $categories);
        }

        return $responder(false, $categories, $form);
    }
}