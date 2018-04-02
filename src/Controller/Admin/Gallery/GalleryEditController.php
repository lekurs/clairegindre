<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/03/2018
 * Time: 14:09
 */

namespace App\Controller\Admin\Gallery;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Controller\InterfacesController\Admin\GalleryEditControllerInterface;
use App\Entity\Gallery;
use App\Entity\Picture;
use App\Type\GalleryOrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class GalleryEditController implements GalleryEditControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $form;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UrlGeneratorInterface
     */
    private $url;

    /**
     * GalleryEditController constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $form
     * @param GalleryBuilderInterface $galleryBuilder
     * @param EntityManagerInterface $entityManager
     * @param UrlGeneratorInterface $url
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $form,
        GalleryBuilderInterface $galleryBuilder,
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $url
    ) {
        $this->twig = $twig;
        $this->form = $form;
        $this->galleryBuilder = $galleryBuilder;
        $this->entityManager = $entityManager;
        $this->url = $url;
    }


    /**
     * @Route(name="adminGalleryEdit", path="admin/edit/gallery/{id}")
     * @param $id
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $gallery = $this->entityManager->getRepository(Gallery::class)->getWithPictures($request->attributes->get('id'));

        $editType = $this->form->create(GalleryOrderType::class, $gallery)->handleRequest($request);

        return new Response($this->twig->render('back/admin/gallery_edit.html.twig', array(
            'form' => $editType->createView(),
        )));
    }
}