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
use App\UI\Action\Blog\Interfaces\AdminBlogChoosePicturesActionInterface;
use App\UI\Responder\Interfaces\AdminBlogChoosePicturesResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AdminBlogChoosePicturesAction
 *
 * @Route(
 *     name="adminAddArticleSelectPictures",
 *     path="admin/blog/create/article"
 * )
 * @package App\UI\Action\Blog
 */
class AdminBlogChoosePicturesAction implements AdminBlogChoosePicturesActionInterface
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
     * @var Session
     */
    private $session;

    /**
     * AdminBlogChoosePicturesAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param Session $session
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        Session $session
    ) {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->session = $session;
    }


    public function __invoke(Request $request, AdminBlogChoosePicturesResponderInterface $responder)
    {
        $pictures = $this->entityManager->getRepository(Gallery::class)->getWithPictures($this->session->get('gallery')['gallery']);

        $form = $this->formFactory->create(SelectPicturesForArticleType::class, $pictures)->handleRequest($request);

        return $responder($pictures->getPictures());
    }
}