<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:23
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddArticleResponderInterface
{
    /**
     * AddArticleResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $rulGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $rulGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $gallery
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, $gallery);
}
