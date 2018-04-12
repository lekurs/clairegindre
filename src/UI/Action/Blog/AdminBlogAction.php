<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:20
 */

namespace App\UI\Action\Blog;


use App\UI\Action\Admin\Interfaces\AdminGalleryActionInterface;
use App\UI\Responder\Interfaces\AdminBlogResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminBlogAction
 *
 * @Route(
 *     name="adminBlog",
 *     path="admin/blog"
 * )
 *
 * @package App\UI\Action\Blog
 */
class AdminBlogAction implements AdminGalleryActionInterface
{
    public function __invoke(AdminBlogResponderInterface $responder)
    {
        return $responder();
    }
}