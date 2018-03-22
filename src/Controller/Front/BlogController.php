<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/03/2018
 * Time: 10:38
 */

namespace App\Controller\Front;


use App\Builder\CategoryBuilder;
use App\Controller\InterfacesController\BlogControllerInterface;
use App\Lib\InstagramLib;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BlogController implements BlogControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var InstagramLib
     */
    private $insta;

    /**
     * @var CategoryBuilder
     */
    private $category;

    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        InstagramLib $insta,
        CategoryBuilder $categoryBuilder
)    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->insta = $insta;
        $this->category = $categoryBuilder;
    }

    /**
     * @Route(path="/blog", methods={"GET"})
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $instagram = $this->insta->show();
        $this->category->create();

        $contactType = $this->formFactory->create('App\Type\ContactType');

        return new Response($this->twig->render('front/blog.html.twig', array(
            'json' => $instagram,
            'contact' => $contactType->createView(),
        )));
    }

}