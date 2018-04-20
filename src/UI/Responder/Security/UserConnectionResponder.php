<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/04/2018
 * Time: 08:55
 */

namespace App\UI\Responder\Security;


use App\UI\Responder\Security\Interfaces\UserConnectionResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class UserConnectionResponder implements UserConnectionResponderInterface
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
     * UserConnectionResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke()
    {
        $response = new Response($this->twig->render('back/security/login.html.twig'));

        return $response;
    }
}