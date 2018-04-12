<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:20
 */

namespace App\UI\Action\Admin;


use App\UI\Action\Admin\Interfaces\AdminGalleryActionInterface;
use App\UI\Responder\Admin\Interfaces\AdminGalleryResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminGalleryAction
 *
 * @Route(
 *     name="adminGallery",
 *     path="admin/gallery"
 * )
 *
 * @package App\UI\Action\Admin
 */
class AdminGalleryAction implements AdminGalleryActionInterface
{
    public function __invoke(AdminGalleryResponderInterface $response)
    {
        return $response();
    }

}