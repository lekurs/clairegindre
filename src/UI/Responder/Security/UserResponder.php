<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 17:07
 */

namespace App\UI\Responder\Security;

use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class UserResponder implements UserResponderInterface
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
     * UserResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke($redirect = false, FormInterface $form = null, $users)
    {
        $redirect ? $response = new RedirectResponse($this->urlGenerator->generate('adminAddGallery')) : $response = new Response($this->twig->render('back/admin/users.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]));
        return $response;
    }

}