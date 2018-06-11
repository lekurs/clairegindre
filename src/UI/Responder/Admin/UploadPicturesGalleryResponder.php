<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 21:50
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\UploadPicturesGalleryResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class UploadPicturesGalleryResponder implements UploadPicturesGalleryResponderInterface
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

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke()
    {
        return new Response($this->twig->render('back/admin/gallery_edit.html.twig', [

        ]));
    }
}
