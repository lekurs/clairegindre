<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/04/2018
 * Time: 08:55
 */

namespace App\UI\Responder\Security\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface UserConnectionResponderInterface
{
    /**
     * UserConnectionResponderInterface constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

}