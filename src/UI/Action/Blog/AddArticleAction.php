<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:17
 */

namespace App\UI\Action\Blog;


use App\Domain\Form\Type\AddArticleType;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Action\Blog\Interfaces\AddArticleActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddArticleResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddArticleAction.
 *
 * @Route(
 *     name="adminAddArticle",
 *     path="/admin/article/create/{slug}"
 * )
 */
class AddArticleAction implements AddArticleActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddArticleTypeHandlerInterface
     */
    private $addArticleTypeHandler;

    /**
     * AddArticleAction constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository, FormFactoryInterface $formFactory, AddArticleTypeHandlerInterface $addArticleTypeHandler)
    {
        $this->galleryRepository = $galleryRepository;
        $this->formFactory = $formFactory;
        $this->addArticleTypeHandler = $addArticleTypeHandler;
    }


    /**
     * @param Request $request
     * @param AddArticleResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddArticleResponderInterface $responder)
    {
        $gallery = $this->galleryRepository->getOne($request->get('slug'));

        $addArticleType = $this->formFactory->create(AddArticleType::class)->handleRequest($request);

        if($this->addArticleTypeHandler->handle($addArticleType)) {

            return $responder(true, null, $gallery);
        }
        return $responder(false, $addArticleType, $gallery);
    }
}
