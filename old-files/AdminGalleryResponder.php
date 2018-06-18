<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 11:22
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\AdminGalleryResponderInterface;
use Twig\Environment;

class AdminGalleryResponder implements AdminGalleryResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AdminGalleryResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke($gallery)
    {
        return $this->twig->render('back/admin/gallery.html.twig', [
            'gallery' => $gallery,
        ]);
    }

}