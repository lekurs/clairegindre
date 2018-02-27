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

//        $user = $this->getDoctrine()
//            ->getRepository(User::class)
//            ->findOneBy(['id' => $id]);

        $gallery = $this->getDoctrine()
            ->getRepository(Gallery::class)
            ->findOneBy(['user' => $id]);

        var_dump($user);

//        if(!$gallery) {
//            throw $this->createNotFoundException(
//                'Pas de galerie photo pour ce client'
//            );
//        }



        $benefit_form = $this->createForm(BenefitType::class, $benefitBuilder->getBenefit())->handleRequest($request);

        if($benefit_form->isSubmitted() && $benefit_form->isValid()) {
//            Ajout de la galerie photo

//            $em = $this->getDoctrine()->getManager()
//                ->getRepository(User::class)
//                ->find('2');
//
//            $galerie = new Gallery();
//            $galerie->setUser($em);
//
//            $benefit = new Benefit();
//            $emBene = $this->getDoctrine()->getManager()
//                ->getRepository(Benefit::class)
//                ->find('2');
//
//            $galerie->setBenefit($emBene);
//
//            $env = $this->getDoctrine()->getManager();
//            $env->persist($galerie);
//            $env->flush();
//
//            $users = new User();
//
//            $users->setId($user->getId());
//
//            var_dump($user->getId());
//
            var_dump($userBuilder->getUser());
            die();
            $galleryBuilder->withUser($userBuilder->getUser());
            $galleryBuilder->withBenefit($benefitBuilder->getBenefit());

            var_dump($galleryBuilder->withUser($userBuilder->getUser()->getId()));
            die();

            $em = $this->getDoctrine()->getManager();
            $em->persist($galleryBuilder->getGallery());
            $em->flush();
//
            $this->addFlash('gallery_succes', 'Galerie ajoutée');
//
            $this->redirectToRoute('adminGallery');
        }

        $gallery_form = $this->createForm(GalleryType::class, $pictureBuilder->getPicture())->handleRequest($request);

//        if($gallery_form->isSubmitted() && $gallery_form->isValid()) {
//
//            $this->addFlash('gallery_success', 'La galerie à bien été mise à jour');
//            return $this->redirectToRoute('adminUsers');
//        }

        return $this->render('back/admin/gallery.html.twig', array(
            'gallery_form' => $gallery_form->createView(),
            'user' => $user,
            'gallery' => $gallery,
            'benefit_form' => $benefit_form->createView(),
        ));
    }
}