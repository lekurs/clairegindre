<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 17:34
 */

namespace App\UI\Responder\Blog;


use App\UI\Responder\Interfaces\BlogResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class BlogResponder implements BlogResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * BlogResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param FormInterface|null $form
     * @param $instagram
     * @param $galleries
     * @param $benefits
     * @param $reviews
     * @return mixed|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormInterface $form = null, $instagram, $galleries, $benefits, $reviews)
    {
        return new Response($this->twig->render('front/blog.html.twig', [
            'galleries' => $galleries,
            'contact' => $form->createView(),
            'insta' => $instagram,
            'benefits' => $benefits,
            'reviews' => $reviews
        ]));
    }
}
