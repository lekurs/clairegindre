<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 17:27
 */

namespace App\Controller\Configuration;


use App\Builder\BenefitBuilder;
use App\Entity\Benefit;
use App\Type\BenefitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BenefitEditController extends Controller
{
    public function edit($id, Request $request, BenefitBuilder $benefitBuilder)
    {
        $benefitBuilder->create();

        $benefit = $this->getDoctrine()
            ->getRepository(Benefit::class)
            ->find($id);

        $benefitType = $this->createForm(BenefitType::class, $benefit)->handleRequest($request);

        if($benefitType->isSubmitted() && $benefitType->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $benefitBuilder->withName($benefitType->getName()); //Pas certain de moi là :/
            $em->flush();

            $this->addFlash('benefitEdit_success', 'La prestation a été mise à jour');

            return $this->redirectToRoute('adminBenefit');
        }

        return $this->render('back/admin/benefit_edit.html.twig', array(
            'benefitType' => $benefitType->createView(),
            'benefits' => $benefit,
        ));
    }
}