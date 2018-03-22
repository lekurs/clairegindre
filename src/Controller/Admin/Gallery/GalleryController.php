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
use App\Entity\Gallery;
use App\Entity\User;
use App\Lib\UploadGalleryLib;
use App\Services\PictureService;
use App\Type\GalleryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function show($id, Request $request, GalleryBuilder $galleryBuilder, PictureBuilder $pictureBuilder, UserBuilder $userBuilder)
    {
        $galleryBuilder->create();
        $pictureBuilder->create();
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

        $gallery_form = $this->createForm(GalleryType::class, $pictureBuilder->getPicture())->handleRequest($request);


        if($gallery_form->isSubmitted() && $gallery_form->isValid()) {
            $fileSystem = new Filesystem();

            try{
                $fileSystem->mkdir('gallery/', 0700);
            } catch (IOExceptionInterface $exception) {
                echo "une erreur est survenue durant la création du répertoire : ".$exception->getPath();
            }

            $fileSystem->mkdir('gallery/upload/'.$user->getLastName());

            foreach($request->files as $file)
            {
                foreach ($file as $picture)
                {dump($picture);
                    foreach ($picture as $upload)
                    {
                        dump($picture['name']);
                        //Upload de l'image
                        $upload->move('gallery/upload/'.$user->getLastName(), $upload->getClientOriginalName());
                        $pictureBuilder->withName($upload->getClientOriginalName());
                        $pictureBuilder->withUserName($user->getLastName());
                        $pictureBuilder->withPath('gallery/upload/'.$user->getLastName());
                        dump($pictureBuilder->getPicture());
//                        $galleryBuilder->withUser($user)->withBenefit($pictureBuilder->getPicture()->getBenefit());
                        dump($galleryBuilder->getGallery());
                        die();

                        //Ajout en bdd
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($galleryBuilder->getGallery());
                        $em->persist($pictureBuilder->getPicture());
                        $em->flush();
                    }
                }
            }
            die();
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

    private function retrieveAction(Request $request)
    {
        $file = $request->files->get('gallery[picture]');
        $status = array('status' => "success", "fileUploaded" => false);

        if(!is_null($file)) {
            $filename = $file->getClientOriginalExtension();
            $path = "test";
            $file->move($path,$filename);
            $status = array('status' => "success", "fileUploaded" => true);
        }
        return new JsonResponse($status);
    }
}
