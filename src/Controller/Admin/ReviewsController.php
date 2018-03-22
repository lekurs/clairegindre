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
use App\Controller\InterfacesController\ReviewsControllerInterface;
use App\Type\ReviewsType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ReviewsController implements ReviewsControllerInterface
{
    /**
     * @var PictureBuilder
     */
    private $pictureBuilder;

    /**
     * @var ReviewsBuilder
     */
    private $reviewBuilder;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    public function __construct(
        Environment $twig,
        PictureBuilder $pictureBuilder,
        ReviewsBuilder $reviewsBuilder,
        EntityManagerInterface $manager,
        FormFactoryInterface $formFactory
    ) {
            $this->twig = $twig;
            $this->pictureBuilder = $pictureBuilder;
            $this->reviewBuilder = $reviewsBuilder;
            $this->manager = $manager;
            $this->formFactory = $formFactory;
    }

    /**
     * @Route(path="/admin/interface/reviews", methods={"GET"})
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $this->reviewBuilder->create();
        $reviewsForm = $this->formFactory->create(ReviewsType::class, $this->reviewBuilder->getReviews())->handleRequest($request);

//        if()
//        {
//            $this->pictureBuilder->withBenefit('slider');
//            $this->pictureBuilder->withUserName($this->reviewBuilder->getReviews()->getName());
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($this->reviewBuilder->getReviews());
//            $em->flush();
//
//            return $this->redirectToRoute('adminReviews');
//        }

        return new Response($this->twig->render('back/admin/slider_reviews.html.twig', array(
            'reviewsForm' => $reviewsForm->createView(),
        )));
    }
}