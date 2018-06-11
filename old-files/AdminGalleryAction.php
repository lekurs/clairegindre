<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:20
 */

namespace App\UI\Action\Admin;


use App\Domain\Models\Gallery;
use App\UI\Action\Admin\Interfaces\AdminGalleryActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AdminGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminGalleryAction
 *
 * @Route(
 *     name="adminGallery",
 *     path="admin/gallery"
 * )
 *
 * @package App\UI\Action\Admin
 */
final class AdminGalleryAction implements AdminGalleryActionInterface
{
    private $galleryRepository;

    private $formFactory;

    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory, AddArticleTypeHandlerInterface $addArticleTypeHandler)
    {
        parent::__construct($entityManager, $formFactory, $addArticleTypeHandler);
    }


    public function __invoke(AdminGalleryResponderInterface $response)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->showAll();

        return $response($gallery);
    }

}