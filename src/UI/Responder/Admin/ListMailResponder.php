<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 16:58
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\ListMailResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class ListMailResponder implements ListMailResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ListMailResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param array $mails
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(array $mails)
    {
        return new Response($this->twig->render('back/admin/list_mails.html.twig', [
            'mails' => $mails
        ]));
    }
}
