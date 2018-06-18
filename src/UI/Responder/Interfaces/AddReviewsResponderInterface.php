<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 13:59
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddReviewsResponderInterface
{
    /**
     * AddReviewsResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $reviews
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, $reviews);
}
