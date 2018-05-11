<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 10:15
 */

namespace App\UI\Action\Blog;


use App\Domain\Form\Type\SelectGalleryForArticleType;
use App\Domain\Models\Gallery;
use App\UI\Action\Blog\Interfaces\AdminBlogChooseGalleryActionInterface;
use App\UI\Responder\Interfaces\AdminBlogChooseGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminBlogChooseGalleryAction
 *
 * @Route(
 *     name="adminAddArticleSelectGallery",
 *     path="admin/blog/article/1"
 * )
 *
 * @package App\UI\Action\Blog
 */
class AdminBlogChooseGalleryAction implements  AdminBlogChooseGalleryActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AdminBlogChooseGalleryAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * @param AdminBlogChooseGalleryResponderInterface $responder
     * @return mixed
     */
    public function __invoke(AdminBlogChooseGalleryResponderInterface $responder)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->getGalleryWithoutArticle();

        $form = $this->formFactory->create(SelectGalleryForArticleType::class, $gallery);

        dump($form->getData());

        return $responder(false, $form);
    }

}