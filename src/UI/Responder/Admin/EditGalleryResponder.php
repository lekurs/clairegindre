<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 13/04/2018
 * Time: 14:50
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\EditGalleryResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

class EditGalleryResponder implements EditGalleryResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * EditGalleryResponder constructor.
     * @param Environment $twig
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, ValidatorInterface $validator, SessionInterface $session, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->validator = $validator;
        $this->session = $session;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke($redirect = false, FormInterface $form = null, $gallery)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('admin')) : $response = new Response($this->twig->render('back/admin/gallery_edit.html.twig', [
            'gallery' => $gallery,
            'form' => $form->createView(),
        ]));

        return $response;
    }
}