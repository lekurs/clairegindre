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
use App\Entity\Benefit;
use App\Entity\Gallery;
use App\Entity\User;
use App\Lib\UploadGalleryLib;
use App\Type\BenefitType;
use App\Type\GalleryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{

    public function show($id, Request $request, GalleryBuilder $galleryBuilder, PictureBuilder $pictureBuilder, BenefitBuilder $benefitBuilder, UserBuilder $userBuilder)
    {
        $galleryBuilder->create();
        $pictureBuilder->create();
        $benefitBuilder->create();
        $userBuilder->create();

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

        $gallery_form = $this->createForm(GalleryType::class, $galleryBuilder->getGallery())->handleRequest($request);

        if($gallery_form->isSubmitted() && $gallery_form->isValid()) {
//            Ajout de la galerie photo

            $galleryBuilder->withUser($userBuilder->getUser()); //User depuis BDD => à modifier $user->getId()
            $galleryBuilder->withBenefit($benefitBuilder->getBenefit());

            $em = $this->getDoctrine()->getManager();
            $em->persist($galleryBuilder->getGallery());
            $em->flush();
//
            $this->addFlash('gallery_succes', 'Galerie ajoutée');
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
}