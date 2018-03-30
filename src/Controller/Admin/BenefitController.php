<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/03/2018
 * Time: 16:36
 */

namespace App\Controller\Admin;


use App\Builder\Interfaces\BenefitBuilderInterface;
use App\Controller\InterfacesController\Admin\BenefitControllerInterface;
use App\Entity\Benefit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class BenefitController implements BenefitControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $form;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var BenefitBuilderInterface
     */
    private $benefitBuilder;

    /**
     * @var UrlGeneratorInterface
     */
    private $url;

    /**
     * BenefitController constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $form
     * @param EntityManagerInterface $manager
     * @param BenefitBuilderInterface $benefitBuilder
     * @param UrlGeneratorInterface $url
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $form,
        EntityManagerInterface $manager,
        BenefitBuilderInterface $benefitBuilder,
        UrlGeneratorInterface $url
    ) {
        $this->twig = $twig;
        $this->form = $form;
        $this->manager = $manager;
        $this->benefitBuilder = $benefitBuilder;
        $this->url = $url;
    }

    /**
     * @Route(name="adminBenefit", path="admin/benefit")
     */
    public function __invoke(Request $request)
    {
        $this->benefitBuilder->create();

        $benefits = $this->manager->getRepository(Benefit::class)->findAll();

        $benefitType = $this->form->create('AddBenefitType')->handleRequest($request);

        if($benefitType->isSubmitted() && $benefitType->isSubmitted()) {
            $em = $this->manager;
            $em->persist($benefitType->getData());
            $em->flush();

            return new RedirectResponse($this->url->generate('admin')); //Voir avec Guillaume
        }

        return new Response($this->twig->render('back/admin/benefit.html.twig', array(
            'benefitType' => $benefitType->createView(),
            'benefits' => $benefits,
        )));
    }

}