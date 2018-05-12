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
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Action\Blog\Interfaces\AdminBlogChoosePicturesActionInterface;
use App\UI\Responder\Interfaces\AdminBlogChoosePicturesResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


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
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * AdminBlogChoosePicturesAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param GalleryRepositoryInterface $galleryRepository
     * @param SessionInterface $session
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        GalleryRepositoryInterface $galleryRepository,
        SessionInterface $session = null,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->formFactory = $formFactory;
        $this->galleryRepository = $galleryRepository;
        $this->session = $session;
        $this->authorizationChecker = $authorizationChecker;
    }


    public function __invoke(Request $request, AdminBlogChoosePicturesResponderInterface $responder)
    {
        if (false === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Vous n\'avez pas les droits d\'accès Administrateur');
        }

        if ($this->session->has('gallery') && is_string($this->session->get('gallery')->id)) {

            $gallery = $this->galleryRepository->getWithPicturesById($this->session->get('gallery')->id);

            if (is_null($gallery)) {
                throw new Exception('Ajouter des images dans la galerie avant de créer le blog');
            }

            dump($gallery);

            $form = $this->formFactory->create(SelectPicturesForArticleType::class, $gallery)->handleRequest($request);

            return $responder(false, $gallery);
        }
    }
}
