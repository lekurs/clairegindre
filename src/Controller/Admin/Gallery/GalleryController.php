<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 15:16
 */

namespace App\Controller\Admin\Gallery;


use App\Builder\GalleryBuilder;
use App\Builder\PictureBuilder;
use App\Entity\Gallery;
use App\Entity\User;
use App\Type\GalleryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{

    public function show($id, Request $request, GalleryBuilder $galleryBuilder, PictureBuilder $pictureBuilder)
    {
        $galleryBuilder->create();
        $pictureBuilder->create();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['id' => $id]);

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

            $this->addFlash('gallery_success', 'La galerie à bien été mise à jour');
            return $this->redirectToRoute('adminUsers');
        }

        return $this->render('back/admin/gallery.html.twig', array(
            'gallery_form' => $gallery_form->createView(),
            'user' => $user,
            'gallery' => $gallery,
        ));
    }
}