<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 13:51
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface DeleteReviewsResponderInterface
{
    /**
     * DeleteReviewsResponderInterface constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator);

    /**
     * @return mixed
     */
    public function __invoke();
}