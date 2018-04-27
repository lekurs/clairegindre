<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 21:50
 */

namespace App\UI\Responder\Admin;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class UploadPicturesGalleryResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * UploadPicturesGalleryResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        return new Response($this->twig->render('back/admin/gallery_edit.html.twig', [

        ]));
    }


}