<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 11:22
 */

namespace App\Controller\Admin\Blog;


use App\Builder\BenefitBuilder;
use App\Builder\CategoryBuilder;
use App\Builder\Interfaces\InterfacesController\Admin\CategoryControllerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CategoryController implements CategoryControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var CategoryBuilder
     */
    private $categoryBuilder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * CategoryController constructor.
     * @param Environment $twig
     * @param CategoryBuilder $categoryBuilder
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $manager
     */
    public function __construct(Environment $twig, CategoryBuilder $categoryBuilder, FormFactoryInterface $formFactory, EntityManagerInterface $manager)
    {
        $this->twig = $twig;
        $this->categoryBuilder = $categoryBuilder;
        $this->formFactory = $formFactory;
        $this->manager = $manager;
    }

    /**
     * @Route(path="/admin/blog")
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $this->categoryBuilder->create();

        $categories = $this->manager->getRepository('App:Category')->getAll();

        $categoryType = $this->formFactory->create('App\Type\CategoryType', $this->categoryBuilder->getCategory())->handleRequest($request);

        if($categoryType->isSubmitted() && $categoryType->isValid()) {
            //On récupère l'entité chargée
            $category = $this->categoryBuilder->getCategory();

            $em = $this->manager;
            $em->persist($category);
            $em->flush();

//            return new RedirectResponse($this->tw);
        }

        return new Response($this->twig->render('back/admin/blog.html.twig', array(
            'categoryType' => $categoryType->createView(),
            'categories' => $categories,
        )));
    }

}