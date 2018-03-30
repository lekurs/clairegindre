<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/03/2018
 * Time: 14:09
 */

namespace App\Controller\Admin\Gallery;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Controller\InterfacesController\Admin\EditGalleryControllerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class EditGalleryController implements EditGalleryControllerInterface
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
     * EditGalleryController constructor.
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
     * @Route(name="adminEditGallery", path="admin/edit/gallery/{id}")
     * @param $id
     * @param Request $request
     */
    public function __invoke($id, Request $request)
    {
        // TODO: Implement __invoke() method.
    }
}