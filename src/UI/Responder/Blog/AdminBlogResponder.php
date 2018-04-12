<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:24
 */

namespace App\UI\Responder\Blog;


use App\UI\Responder\Interfaces\AdminBlogResponderInterface;
use Twig\Environment;

class AdminBlogResponder implements AdminBlogResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AdminBlogResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        return $this->twig->render('back/admin/blog.html.twig');
    }
}