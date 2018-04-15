<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:20
 */

namespace App\UI\Action\Admin;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\UI\Action\Admin\Interfaces\AdminGalleryActionInterface;
use App\UI\Responder\Admin\Interfaces\AdminGalleryResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
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
class AdminGalleryAction implements AdminGalleryActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    public function __invoke(AdminGalleryResponderInterface $response)
    {
        $gallery = $this->entityManager->getRepository(GalleryInterface::class)->showAll();

        return $response($gallery);
    }

}