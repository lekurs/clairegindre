<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 30/03/2018
 * Time: 11:03
 */

namespace App\Controller\Admin\Gallery;


use App\Controller\InterfacesController\Gallery\GalleryControllerInterface;
use App\Entity\Gallery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class GalleryController implements GalleryControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * GalleryController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(name="adminGallery", path="admin/gallery", methods={"GET"})
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke()
    {
        $galleryByUser = $this->entityManager->getRepository(Gallery::class)->showGalleryByUser();

        return new Response($this->twig->render('back/admin/gallery.html.twig', array(
            'galleryByUser' => $galleryByUser,
        )));
    }
}
