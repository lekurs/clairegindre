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
use App\Builder\Interfaces\InterfacesController\GalleryControllerInterface;
use App\Builder\PictureBuilder;
use App\Builder\UserBuilder;
use App\Entity\Gallery;
use App\Entity\User;
use App\Lib\UploadGalleryLib;
use App\Type\GalleryType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class GalleryController extends Controller
{

    /**
     * @param $id
     * @param Request $request
     * @param GalleryBuilder $galleryBuilder
     * @param PictureBuilder $pictureBuilder
     * @param BenefitBuilder $benefitBuilder
     * @param UserBuilder $userBuilder
     * @return mixed
     *
//     * @Route(path="admin/gallery/{id}", methods={"GET"})
     */
    public function show($id, Request $request, GalleryBuilder $galleryBuilder, PictureBuilder $pictureBuilder)
    {
        $galleryBuilder->create();
        $pictureBuilder->create();

//        $user = $entityManager->getRepository(User::class)->showOne($id);

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->showOne($id);

        $gallery = $this->getDoctrine()
            ->getRepository(Gallery::class)
            ->findOneBy(['user' => $id]);


//        if(!$gallery) {
//            throw $this->createNotFoundException(
//                'Pas de galerie photo pour ce client'
//            );
//        }

        $gallery_form = $this->createForm(GalleryType::class, $pictureBuilder->getPicture())->handleRequest($request);

        if($gallery_form->isSubmitted() && $gallery_form->isValid()) {
//            Ajout de la galerie photo

//            $galleryBuilder->withUser($userBuilder->getUser()); //User depuis BDD => à modifier $user->getId()
//            $galleryBuilder->withBenefit($benefitBuilder->getBenefit());

            //Upload des fichiers images de la gallerie dans le répertoire correspondant

//            $em = $entityManager->getEventManager();

//            $em = $this->getDoctrine()->getManager();
//            $em->persist($galleryBuilder->getGallery());
//            $em->flush();
//
//            $this->addFlash('gallery_succes', 'Galerie ajoutée');
//
            $this->redirectToRoute('adminGallery');
        }

//            $this->addFlash('gallery_success', 'La galerie à bien été mise à jour');
//            return $this->redirectToRoute('adminUsers');
//        }

        return $this->render('back/admin/gallery.html.twig', array(
            'gallery_form' => $gallery_form->createView(),
            'user' => $user,
            'gallery' => $gallery,
        ));
    }

//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->EntityManagerInterface = $entityManager;
//    }
}