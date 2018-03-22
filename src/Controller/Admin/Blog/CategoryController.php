<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 11:22
 */

namespace App\Controller\Admin\Blog;

use App\Builder\CategoryBuilder;
use App\Controller\InterfacesController\Admin\CategoryControllerInterface;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
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
     * @Route(name="adminBlog", path="/admin/blog")
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $this->categoryBuilder->create();

        $categories = $this->manager->getRepository(Category::class)->getAll();

        $categoryType = $this->formFactory->create(Category::class, $this->categoryBuilder->getCategory())->handleRequest($request);

        if($categoryType->isSubmitted() && $categoryType->isValid()) {
            //On récupère l'entité chargée
            $category = $this->categoryBuilder->getCategory();

            $em = $this->manager;
            $em->persist($category);
            $em->flush();

//            return new RedirectResponse($this->tw); urlGeneratorInterface
        }

        return new Response($this->twig->render('back/admin/blog.html.twig', array(
            'categoryType' => $categoryType->createView(),
            'categories' => $categories,
        )));
    }

}