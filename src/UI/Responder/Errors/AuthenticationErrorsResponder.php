<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 20/06/2018
 * Time: 17:02
 */

namespace App\UI\Responder\Errors;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AuthenticationErrorsResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AuthenticationErrorsResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        return new Response($this->twig->render('errors/authentication.html.twig'));
    }
}