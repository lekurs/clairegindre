<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 14/02/2018
 * Time: 15:26
 */

namespace App\Controller\Admin;


use App\Builder\PictureBuilder;
use App\Builder\ReviewsBuilder;
use App\Type\ReviewsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReviewsController extends Controller
{
    public function show(Request $request, ReviewsBuilder $reviewsBuilder, PictureBuilder $pictureBuilder)
    {
        $reviewsBuilder->create();
        $pictureBuilder->create();

        $reviewsForm = $this->createForm(ReviewsType::class, $reviewsBuilder->getReviews())->handleRequest($request);

        if($reviewsForm->isSubmitted() && $reviewsForm->isValid())
        {
            $pictureBuilder->withBenefit('slider');
            $pictureBuilder->withUserName($reviewsBuilder->getReviews()->getName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($reviewsBuilder->getReviews());
            $em->flush();

            return $this->redirectToRoute('adminReviews');
        }

        return $this->render('back/admin/slider_reviews.html.twig', array(
            'reviewsForm' => $reviewsForm->createView(),
        ));
    }
}