<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 11:17
 */

namespace App\UI\Responder\Blog;


use App\UI\Responder\Interfaces\AdminBlogChoosePicturesResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class AdminBlogChoosePicturesResponder
 * @package App\UI\Responder\Blog
 */
class AdminBlogChoosePicturesResponder implements AdminBlogChoosePicturesResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * AdminBlogChoosePicturesResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke($pictures)
    {
        return new Response($this->twig->render('back/admin/Article/add_article_select_pictures.html.twig', array(
            'pictures' => $pictures
        )));
    }

}