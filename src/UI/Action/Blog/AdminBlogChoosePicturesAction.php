<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 12:13
 */

namespace App\UI\Action\Blog;
use App\Domain\Form\Type\SelectPicturesForArticleType;
use App\Domain\Models\Gallery;
use App\UI\Responder\Interfaces\AdminBlogChoosePicturesResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AdminBlogChoosePicturesAction
 *
 * @Route(
 *     name="adminAddArticleSelectPictures",
 *     path="admin/blog/article/2/{id}"
 * )
 * @package App\UI\Action\Blog
 */
class AdminBlogChoosePicturesAction
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
     * AdminBlogChoosePicturesAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, AdminBlogChoosePicturesResponderInterface $responder)
    {
        $pictures = $this->entityManager->getRepository(Gallery::class)->getWithPictures($request->get('id'));

        $form = $this->formFactory->create(SelectPicturesForArticleType::class, $pictures)->handleRequest($request);

        return $responder($pictures->getPictures());
    }
}