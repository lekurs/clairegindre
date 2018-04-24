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

class BlogResponder implements BlogResponderInterface
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

    public function __invoke(FormInterface $form = null, $instagram, $articles, $benefits)
    {
        return new Response($this->twig->render('front/blog.html.twig', [
            'articles' => $articles,
            'contact' => $form->createView(),
            'insta' => $instagram,
            'benefits' => $benefits
        ]));
    }

}