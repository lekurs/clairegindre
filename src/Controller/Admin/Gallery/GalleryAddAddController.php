<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:16
 */

namespace App\Controller\Admin\Gallery;


use App\Builder\BenefitBuilder;
use App\Builder\GalleryBuilder;
use App\Builder\PictureBuilder;
use App\Builder\UserBuilder;
use App\Controller\InterfacesController\GalleryAddControllerInterface;
use App\Entity\Gallery;
use App\Entity\Picture;
use App\Entity\User;
use App\Lib\UploadGalleryLib;
use App\Services\PictureUploaderHelper;
use App\Type\GalleryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class GalleryAddAddController implements GalleryAddControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var GalleryBuilder
     */
    private $galleryBuilder;

    /**
     * @var PictureBuilder
     */
    private $pictureBuilder;

    /**
     * @var UserBuilder
     */
    private $userBuilder;

    /**
     * @var BenefitBuilder
     */
    private $benefitBuilder;

    /**
     * @var PictureUploaderHelper
     */
    private $pictureService;

    /**
     * @var FormFactoryInterface
     */
    private $form;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * GalleryAddAddController constructor.
     * @param Environment $twig
     * @param GalleryBuilder $galleryBuilder
     * @param PictureBuilder $pictureBuilder
     * @param UserBuilder $userBuilder
     * @param BenefitBuilder $benefitBuilder
     * @param PictureUploaderHelper $pictureService
     * @param FormFactoryInterface $form
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        GalleryBuilder $galleryBuilder,
        PictureBuilder $pictureBuilder,
        BenefitBuilder $benefitBuilder,
        UserBuilder $userBuilder,
        Environment $twig,
        EntityManagerInterface $entityManager,
        FormFactoryInterface $form,
        PictureUploaderHelper $pictureService,
        UrlGeneratorInterface $urlGenerator
    )    {
        $this->twig = $twig;
        $this->galleryBuilder = $galleryBuilder;
        $this->pictureBuilder = $pictureBuilder;
        $this->userBuilder = $userBuilder;
        $this->benefitBuilder = $benefitBuilder;
        $this->pictureService = $pictureService;
        $this->form = $form;
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @Route(name="adminAddGallery", path="/admin/gallery/{id}")
     * @param $id
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($id, Request $request)
    {
        $this->galleryBuilder->create();

        $user = $this->entityManager->getRepository(User::class)
            ->showOne($id);

        $gallery = $this->entityManager->getRepository(Gallery::class)
            ->findOneBy(['user' => $id]);

        $gallery_form = $this->form->create(GalleryType::class, $this->galleryBuilder->getGallery())->handleRequest($request);

        if($gallery_form->isSubmitted() && $gallery_form->isValid()) {

            $this->galleryBuilder->withUser($user);

            //Ajout en bdd
            $em = $this->entityManager;
            $em->persist($this->galleryBuilder->getGallery());
            $em->flush();

//            $this->addFlash('gallery_succes', 'Galerie ajoutée');
//
            return new RedirectResponse($this->urlGenerator->generate('admin'));
        }
        return new Response($this->twig->render('back/admin/add_gallery.html.twig', array(
            'gallery_form' => $gallery_form->createView(),
            'user' => $user
        )));
    }
}
