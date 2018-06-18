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
final class AdminBlogChoosePicturesResponder implements AdminBlogChoosePicturesResponderInterface
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
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param bool $redirect
     * @param null $gallery
     * @return mixed|RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, $gallery = null)
    {
        $redirect ? $response = new RedirectResponse('admin') : $response = new Response($this->twig->render('back/admin/Article/add_article.html.twig', array(
            'gallery' => $gallery
        )));

        return $response;
    }
}
