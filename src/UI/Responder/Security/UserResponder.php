<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 17:07
 */

namespace App\UI\Responder\Security;

use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class UserResponder implements UserResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * UserResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function __invoke($users)
    {
        return new Response($this->twig->render('back/admin/users.html.twig', [
            'users' => $users,
        ]));
    }

}