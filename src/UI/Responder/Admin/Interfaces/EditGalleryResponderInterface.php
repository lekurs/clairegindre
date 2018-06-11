<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 13/04/2018
 * Time: 14:50
 */

namespace App\UI\Responder\Admin\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

interface EditGalleryResponderInterface
{
    /**
     * EditGalleryResponder constructor.
     *
     * @param Environment $twig
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        ValidatorInterface $validator,
        SessionInterface $session,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $gallery
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null, $gallery);
}
