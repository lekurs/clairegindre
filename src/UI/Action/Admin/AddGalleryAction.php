<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 06/04/2018
 * Time: 11:52
 */

namespace App\UI\Action\Admin;


use App\Domain\Form\Type\AddGalleryType;
use App\Domain\Models\User as UserEntity;
use App\UI\Action\Admin\Interfaces\AddGalleryActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AddGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddGalleryAction
 *
 * @Route(
 *     name="adminAddGallery",
 *     path="admin/gallery/{id}"
 * )
 *
 * @package App\UI\Action\Admin
 */
class AddGalleryAction implements AddGalleryActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddGalleryTypeHandlerInterface
     */
    private $galleryHandler;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AddGalleryAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param AddGalleryTypeHandlerInterface $galleryHandler
     */
    public function __construct(FormFactoryInterface $formFactory, AddGalleryTypeHandlerInterface $galleryHandler, EntityManagerInterface $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->galleryHandler = $galleryHandler;
        $this->entityManager = $entityManager;
    }


    public function __invoke(Request $request, AddGalleryResponderInterface $responder)
    {
        $addGalleryType = $this->formFactory->create(AddGalleryType::class)->handleRequest($request);

        $user = $this->entityManager->getRepository(UserEntity::class)->showOne($request->get('id'));

        if($this->galleryHandler->handle($addGalleryType)) {

            return $responder(true);
        }
        return $responder(false, $addGalleryType, $user);
    }
}