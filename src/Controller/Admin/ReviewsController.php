<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 14/02/2018
 * Time: 15:26
 */

namespace App\Controller\Admin;


use App\Entity\Reviews;
use App\Form\ReviewsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReviewsController extends Controller
{
    public function addReviews(Request $request)
    {
        $title = 'Administration des avis clients';

        $reviews = new Reviews();

        $reviewsForm = $this->createForm(ReviewsType::class, $reviews);

        $reviewsForm->handleRequest($request);

        if($reviewsForm->isSubmitted() && $reviewsForm->isValid())
        {

        }

        return $this->render('back/admin/slider_reviews.html.twig', array(
            'title' => $title,
            'reviewsForm' => $reviewsForm->createView(),
        ));
    }
}