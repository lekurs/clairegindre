<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 20:35
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\AnswerMailResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class AnswerMailResponder implements AnswerMailResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * AnswerMailResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function __invoke()
    {
        return new Response($this->twig->render('back/admin/answer_mails.html.twig', [

        ]));
    }
}
