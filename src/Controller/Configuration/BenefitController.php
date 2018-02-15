<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 12:45
 */

namespace App\Controller\Configuration;


use App\Builder\BenefitBuilder;
use App\Type\BenefitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BenefitController extends Controller
{

    public function addBenefit(Request $request, BenefitBuilder $benefitBuilder)
    {
        $benefitBuilder->create();

        $benefitType = $this->createForm(BenefitType::class, $benefitBuilder->getBenefit())->handleRequest($request);

        if($benefitType->isSubmitted() && $benefitType->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($benefitBuilder->getBenefit());
            $em->flush();

            $this->addFlash('benefit_succes', 'Votre prestation à bien été ajoutée');

            $this->redirectToRoute('adminBenefit');
        }

        return $this->render('back/admin/benefit.html.twig', array(
            'benefitType' => $benefitType->createView(),
        ));
    }
}