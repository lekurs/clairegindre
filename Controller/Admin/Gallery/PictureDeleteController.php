<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 30/03/2018
 * Time: 16:21
 */

namespace App\Controller\Admin\Gallery;


use App\Controller\InterfacesController\Admin\PictureDeleteControllerInterface;
use Symfony\Component\Routing\Annotation\Route;

class PictureDeleteController implements PictureDeleteControllerInterface
{

    private $id;

    /**
     * @Route(name="adminDeletePicture", path="admin/edit/gallery/{idGallery}/{idPicture}")
     */
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

}