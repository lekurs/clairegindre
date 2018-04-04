<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 11:25
 */

namespace App\UI\Responder\Admin\Interfaces;


use Twig\Environment;

interface AdminResponderInterface
{
    /**
     * AdminResponderInterface constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @return mixed
     */
    public function __invoke();
}