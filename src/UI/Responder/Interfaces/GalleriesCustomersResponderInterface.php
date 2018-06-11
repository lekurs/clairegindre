<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 17:25
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface GalleriesCustomersResponderInterface
{
    /**
     * GalleriesCustomersResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param bool $redirect
     * @param FormInterface|null $contact
     * @param FormInterface $customerConnectionType
     * @param $galleries
     * @param $insta
     * @param $reviews
     * @param $pagination
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $contact = null, FormInterface $customerConnectionType, $galleries, $insta, $reviews, $pagination);
}
