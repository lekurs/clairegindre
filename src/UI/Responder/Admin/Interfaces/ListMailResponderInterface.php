<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 16:59
 */

namespace App\UI\Responder\Admin\Interfaces;


use Twig\Environment;

interface ListMailResponderInterface
{
    /**
     * ListMailResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param array $mails
     * @return mixed
     */
    public function __invoke(array $mails);
}