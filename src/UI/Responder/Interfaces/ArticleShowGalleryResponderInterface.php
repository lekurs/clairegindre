<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 17:50
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ArticleShowGalleryResponderInterface
{
    /**
     * ArticleShowGalleryResponderInterface constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param FormInterface|null $commentType
     * @param $article
     * @param $data
     * @param $instagram
     * @param $reviews
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, FormInterface $commentType = null, $article, $data, $instagram, $reviews);
}