<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:59
 */

namespace App\UI\Responder\Interfaces;


use App\Domain\Lib\InstagramLib;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface IndexResponderInterface
{
    /**
     * IndexResponderInterface constructor.
     * @param Environment $twid
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twid, UrlGeneratorInterface $urlGenerator, InstagramLib $intagram);

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null);

}