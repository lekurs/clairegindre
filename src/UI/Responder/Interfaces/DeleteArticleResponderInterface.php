<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 10:31
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface DeleteArticleResponderInterface
{
    /**
     * DeleteArticleResponderInterface constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator);

    /**
     * @return mixed
     */
    public function __invoke();
}
